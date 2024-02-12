<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\SaleList;
use App\Models\SaleListReturn;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class CustomerReturnController extends Controller
{
    public function index(Request $request){
        $options = $request->options;
        switch($options){
            case 'lists':
               return $this->lists($request);
            break;
            default : 
            return inertia('Modules/Inventory/Customer/Index');
        }
    }

    public function store(Request $request){

        $request->validate([
            'description' => 'sometimes|required',
            'title' => 'sometimes|required',
        ]);

        $data = \DB::transaction(function () use ($request){
            if($request->editable == 'true'){
                $data = SaleListReturn::where('id',$request->id)->first();
                $data->update($request->except('editable'));
                return $data;
            }else{
                return $data = SaleListReturn::create(array_merge($request->all(),['added_by' => \Auth::user()->id]));
            }
            
        });
        $message = ($request->editable) ? 'updated' : 'created';
        return back()->with([
            'message' => 'Sales '.$message.' successfully. Thanks',
            'data' => new DefaultResource($data),
            'type' => 'bxs-check-circle',
            'color' => 'success'
        ]); 
    }

    public function update(Request $request){
        $request->validate([
            'reason_id' => 'required',
            'reason' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        $data = \DB::transaction(function () use ($request){
            $data = SaleList::where('id',$request->id)->first();
            if($request->quantity == $data->quantity){
                $data->status_id = $request->status_id;
            }else{
                $data->quantity = $data->quantity - $request->quantity;
                $data->total = $data->total - ($data->price*$request->quantity);
            }
            if($request->reason_id == 34){
                $prod = Product::where('id',$data->product_id)->first();
                $prod->stock = $prod->stock + $request->quantity;
                $prod->save();
            }
            if($request->all){
                $s = Sale::where('id',$data->sale_id)->update(['status_id' => 25]);
            }else{
                $s = Sale::where('id',$data->sale_id)->first();
                $s->total = $request->sale_total;
                $s->subtotal = $request->sale_subtotal;
                $s->tax = $request->sale_tax;
                $s->discount = $request->sale_discount;
                $s->save();
            }

            if($data->save()){
                $return = new SaleListReturn;
                $return->reason = $request->reason;
                $return->reason_id = $request->reason_id;
                $return->quantity = $request->quantity;
                $return->total = $request->total;
                $return->salelist_id = $request->id;
                $return->managed_by = \Auth::user()->id;
                $return->save();
            }
        });

        return back()->with([
            'message' => 'Product status updated successfully. Thanks',
            'data' => new DefaultResource($data),
            'type' => 'bxs-check-circle',
            'color' => 'success'
        ]); 
    }

    public function lists($request){
        $data = DefaultResource::collection(
            SaleList::with('product','sale.customer','sale.discounted','status')
            ->whereDate('warranty', '>=', now())
            ->where('status_id',27)
            ->orderBy('id','desc')
            ->paginate(10)
            ->withQueryString()
        );
        return $data;
    }
}
