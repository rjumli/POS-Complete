<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Package;
use App\Models\PackageList;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class PackageController extends Controller
{
    public function index(Request $request){
        $options = $request->options;
        switch($options){
            case 'lists':
               return $this->lists($request);
            break;
            default : 
            return inertia('Modules/Inventory/Packages/Index');
        }
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'information' => 'required',
            'category_id' => 'required',
            'lists' => 'required|array',
            'lists.*' => 'required|array',
            'lists.*.product' => 'required',
            'lists.*.price' => 'required',
            'lists.*.quantity' => 'required|integer|min:1',
        ]);
        $data = \DB::transaction(function () use ($request){
            if($request->editable){
                $data = Package::where('id',$request->id)->first();
                $data->update($request->except('editable'));
                return $data;
            }else{
                $total = 0; $items = [];
                $code = 'PCKG'.date('Y').date('m').date('d')."-".str_pad((Package::count()+1), 4, '0', STR_PAD_LEFT);  
                $lists = $request->lists;
            
                foreach($lists as $list){
                    $total = $total + ($list['price'] * $list['quantity']);
                }

                // foreach($lists as $list){
                //     $id = $list['product']['id'];
                //     $quantityToSubtract = $list['quantity'] * $request->stock;
                //     $product = Product::where('id',$id)->first();
                //     if($product->stock >= $quantityToSubtract){
                    
                //     }else{
                //         $items[] = [
                //             'product' => $product->name,
                //             'stock' => $product->stock,
                //             'order' =>   $quantityToSubtract
                //         ];
                //     }
                // }

                // if(count($items) > 0){
                //   return [
                //     'items' => $items,
                //     'type' => 'error'
                //   ];
                // }

                $data = Package::create(array_merge($request->all(),['code' => $code, 'total' => $total]));
                if($data){
                    foreach($lists as $list){
                        $id = $list['product']['id'];
                        $package = new PackageList;
                        $package->package_id = $data->id;
                        $package->product_id = $list['product']['id'];
                        $package->price = $list['price'];
                        $package->quantity = $list['quantity'];
                        $package->total = $list['quantity']*$list['price'];
                        if($package->save()){
                            $quantityToSubtract = $list['quantity'] * $request->stock;
                            $product = Product::where('id',$id)->decrement('stock', $quantityToSubtract);
                        }
                    }
                }
            }
            
        });
        
        
        // if(count($data['items']) > 0){
            return back()->with([
                'message' => 'Sale was successfull',
                'data' => $data,
                'type' => 'ri-checkbox-circle-fill',
                'color' => 'success'
            ]); 
        // }
    }

    public function lists($request){
        $data = DefaultResource::collection(
            Package::when($request->keyword, function ($query, $keyword) {
                $query->where('name', 'LIKE', '%'.$keyword.'%');
            })
            ->with('lists.product','category')
            ->orderBy('id','asc')
            ->paginate(10)
            ->withQueryString()
        );
        return $data;
    }

    public function update(Request $request){
        $data = Package::where('id',$request->id)->update($request->except('id','type'));
        $data = Package::where('id',$request->id)->first();
        return back()->with([
            'message' => 'Package status updated successfully. Thanks',
            'data' => new DefaultResource($data),
            'type' => 'bxs-check-circle',
            'color' => 'success'
        ]); 
    }
}
