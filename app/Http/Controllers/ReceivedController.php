<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use App\Models\ReceiveOrder;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class ReceivedController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'orderlist_id' => 'required',
            'status_id' => 'required',
            'quantity' => 'required',
            'received' => 'required_if:status_id,8,32',
            'price' => 'required_if:status_id,8,32',
        ]);

        $data = \DB::transaction(function () use ($request){
            $data = OrderList::with('product','status')->where('id',$request->orderlist_id)->first();
            $product_id = $data->product_id;
            $quantity = $data->quantity;
            $received = intval($request->received);
            // dd(intval($received));
            if($request->status_id == 8 || $request->status_id == 32){
                $receiveds = new ReceiveOrder;
                $receiveds->price = $request->price;
                $receiveds->quantity = $received;
                $receiveds->orderlist_id = $request->orderlist_id;
                $receiveds->status_id = $request->status_id;
                $receiveds->save();

                if($receiveds){
                    $product = Product::where('id',$product_id)->first();
                    $product->stock = $product->stock + $received;
                    if($product->price != $request->price){
                        $product->price = $request->price;
                    }
                    $product->save();
                }
            }
            $data->received  = $data->received + $received;
            $data->status_id = $request->status_id;
            $data->save();
            
            $data =  Order::with('lists.product','lists.status','status','supplier.supplier')->where('id',$request->id)->first();
            $allStatusNotEqualSeven = $data->lists->every(function ($list) {
                return $list->status_id == 8;
            });
            if ($allStatusNotEqualSeven) {
                $data->update(['status_id' => 5]);
            }else{
                $data->update(['status_id' => 31]);
            }
            $data = Order::with('lists.product','lists.status','status','supplier.supplier')->where('id',$request->id)->first();
            return $data;
        });

        return back()->with([
            'message' => 'Order updated successfully. Thanks',
            'data' => new DefaultResource($data),
            'type' => 'bxs-check-circle',
            'color' => 'success'
        ]); 
    }
}
