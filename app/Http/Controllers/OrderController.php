<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\SaleList;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index(Request $request){
        $options = $request->options;
        switch($options){
            case 'lists':
               return $this->lists($request->all());
            break;
            case 'view':
                return $this->view($request->all());
            break;
            default : 
            return inertia('Modules/Stocking/Orders/Index');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required',
            'lists' => 'required|array',
            'lists.*' => 'required|array',
            'lists.*.product' => 'required',
            'lists.*.price' => 'required',
            'lists.*.quantity' => 'required|integer|min:1',
        ]);
        $data = \DB::transaction(function () use ($request){
            if($request->editable){
                $data = Order::where('id',$request->id)->first();
                $data->update($request->except('editable'));
                return $data;
            }else{
                $status = 4; $total = 0;
                $code = 'ORDER'.date('Y').date('m').date('d')."-".str_pad((Order::count()+1), 4, '0', STR_PAD_LEFT);  
                $lists = $request->lists;
            
                foreach($lists as $list){
                    $total = $total + ($list['price'] * $list['quantity']);
                }

                $data = Order::create(array_merge($request->all(),['code' => $code, 'status_id' => $status, 'total' => $total]));
                if($data){
                    foreach($lists as $list){
                        $product_id = $list['product']['id'];
                        $order_list = OrderList::where('product_id',$product_id)->latest('created_at')->first();
                        if($order_list != null){
                            $givenDateTime = $order_list->created_at;
                            $currentDateTime = now();
                            $interval = $currentDateTime->diff($givenDateTime);
                            $days = $interval->days;
                        }

                        $order = new OrderList;
                        $order->order_id = $data->id;
                        $order->product_id = $list['product']['id'];
                        $order->price = $list['price'];
                        $order->quantity = $list['quantity'];
                        $order->status_id = 7;

                        if($order->save()){
                            $product = Product::where('id',$product_id)->first();
                            if($order_list != null){
                                $endDate = now();
                                $startDate = $givenDateTime;

                                $sales = SaleList::where('created_at', '>=', $startDate)
                                ->where('created_at', '<=', $endDate)
                                ->where('product_id',$product_id)
                                ->where('status_id', 27)
                                ->get();

                                $average_sales = $sales->sum('quantity');

                                $total = SaleList::where('product_id',$product_id)
                                ->where('status_id', 27)
                                ->get();

                                $total = $total->sum('quantity');

                                $lead = $days;
                                $safety = $product->safety;
                                $demand = $total;

                                $ss =$safety/100 * $demand;
                                $ld = $demand*$lead;
            
                                $reorder = $ld + $ss;
                                
                                $product->reorder = $reorder;
                                $product->save();
                            }else{
                                $lead = $product->lead;
                                $safety = $product->safety;
                                $demand = $product->demand;

                                $ss =$safety/100 * $demand;
                                $ld = $demand*$lead;
            
                                $reorder = $ld + $ss;
                                $product->reorder = $reorder;
                                $product->save();
                            }
                        }
                    }
                }
            }
            
        });
    }

    public function lists($request){
        $keyword = $request['keyword'];

        $data = DefaultResource::collection(
            Order::with('lists.product','lists.status','status','supplier.supplier')
            ->when($keyword, function ($query, $keyword) {
                $query->where('code', 'LIKE', '%'.$keyword.'%');
            })
            ->orderBy('id','asc')
            ->paginate(10)
            ->withQueryString()
        );
        return $data;
    }

    public function view($request){
        $product_id = $request['product_id'];
        $data = DefaultResource::collection(
            OrderList::with('status','order.supplier.supplier')
            ->where('product_id',$product_id)
            ->orderBy('id','desc')
            ->paginate(5)
            ->withQueryString()
        );
        return $data;
    }
}
