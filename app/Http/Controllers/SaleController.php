<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleList;
use App\Models\Package;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\PackageResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\DefaultResource;

class SaleController extends Controller
{
    public function index(Request $request){
        $options = $request->options;
        switch($options){
            case 'lists':
               return $this->lists($request->all());
            break;
            case 'search':
                return $this->search($request->all());
             break;
            case 'cart':
                return $this->cart($request->all());
             break;
            default : 
            return inertia('Modules/Sales/Index');
        }
    }

    public function store(Request $request){

        $request->validate([
            'customer_id' => 'required',
            'discount_id' => 'required',
            'payment_id' => 'required',
            'cash' => 'required',
            'lists' => 'required|array',
            'lists.*' => 'required|array'
        ]);
        $data = \DB::transaction(function () use ($request){
            if($request->editable){
                $data = Sale::where('id',$request->id)->first();
                $data->update($request->except('editable'));
                return $data;
            }else{
                $total = 0;
                $code = 'SLS'.date('Y').date('m').date('d')."-".str_pad((Sale::count()+1), 4, '0', STR_PAD_LEFT);  
                $lists = $request->lists;
                $data = Sale::create(array_merge($request->all(),['code' => $code, 'managed_by' => \Auth::user()->id]));
                if($data){
                    foreach($lists as $list){
                        $l = new SaleList;
                        $l->price = $list['price'];
                        $l->quantity = $list['quantity'];
                        $l->discount = $list['discounted'];
                        $l->total = $list['total'];
                        $l->status_id = 27;
                        $l->type = $list['type'];
                        if($list['type'] == 'Product'){
                            $l->product_id = $list['id'];
                            if($list['has_warranty']){
                                $warranty = $list['warranty'];
                                $currentDate = now();
                                $parts = explode(' ', $warranty);

                                $numericValue = (int)$parts[0];
                                $timeUnit = $parts[1];
// dd($timeUnit);
                                switch($timeUnit){
                                    case 'Years':
                                        $warranty_date = ($numericValue == 1) ? $currentDate->modify('+1 year') :  $currentDate->modify('+'.$numericValue.' years');
                                    break;
                                    case 'Months':
                                        $warranty_date = ($numericValue == 1) ? $currentDate->modify('+1 month') :  $currentDate->modify('+'.$numericValue.' months');
                                    break;
                                    case 'Weeks':
                                        $warranty_date = ($numericValue == 1) ? $currentDate->modify('+1 week') :  $currentDate->modify('+'.$numericValue.' weeks');
                                    break;
                                    case 'Days':
                                        $warranty_date = ($numericValue == 1) ? $currentDate->modify('+1 day') :  $currentDate->modify('+'.$numericValue.' days');
                                    break;
                                }

                                $l->warranty = $warranty_date;
                            }
                        }else{
                            $l->package_id = $list['id'];
                        }
                        $l->sale_id = $data->id;
                        if($l->save()){
                            $id = $list['id'];
                            $quantityToSubtract = $list['quantity'];
                            if($list['type'] == 'Product'){
                                $product = Product::where('id',$id)->decrement('stock', $quantityToSubtract);
                            }else{
                                $product = Package::where('id',$id)->decrement('stock', $quantityToSubtract);
                            }
                        }
                    }
                }

                return back()->with([
                    'message' => 'Sale was successfull. Thanks',
                    'data' => new DefaultResource($data),
                    'type' => 'bxs-check-circle',
                    'color' => 'success'
                ]); 
            }
            
        });
    }

    public function cart($request){
        $keyword = $request['keyword'];
        $data = Product::with('category','unit','pricing','discounts.discount.subtype')->where('code',$keyword)->first();
        if(isset($data)){
            return new ProductResource($data);
        }else{
            $data = Package::with('lists.product','category','discounts.discount.subtype')->where('code',$keyword)->first();
            if(isset($data)){
                return new PackageResource($data);
            }else{
                return new ProductResource($data);
            }
        } 
    }

    public function lists($request){
        $keyword = $request['keyword'];
        $data = DefaultResource::collection(
            Sale::when($keyword, function ($query, $keyword) {
                $query->where('code', 'LIKE', '%'.$keyword.'%');
            })
            ->with('lists.product','lists.package','lists.status','payment','discounted','customer','status')
            ->orderBy('id','desc')
            ->paginate(10)
            ->withQueryString()
        );
        return $data;
    }

    public function search($request){
        $keyword = $request['keyword'];
        $category = $request['category'];
        $data = Product::with('category','unit','pricing','discounts.discount.subtype')
        ->when($keyword, function ($query, $keyword) {
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        })
        ->when($category, function ($query, $category) {
            $query->where('category_id',$category);
        })
        ->paginate(5)
        ->withQueryString();

        if(count($data) > 0){
            return ProductResource::collection($data);
        }else{
            $data = Package::with('lists.product','category','discounts.discount.subtype')
            ->when($keyword, function ($query, $keyword) {
                $query->where('name', 'LIKE', '%'.$keyword.'%');
            })
            ->when($category, function ($query, $category) {
                $query->where('category_id',$category);
            })
            ->paginate(5)
            ->withQueryString();

            if(isset($data)){
                return PackageResource::collection($data);
            }else{
                return ProductResource::collection($data);
            }
        } 
    }
}
