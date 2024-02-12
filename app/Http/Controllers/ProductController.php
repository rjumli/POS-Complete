<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\ProductAdjustment;
use Illuminate\Http\Request;
use App\Rules\UniqueNameBrandCombination;
use App\Http\Resources\DefaultResource;
use App\Http\Resources\ItemResource;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request){
        $options = $request->options;
        switch($options){
            case 'lists':
               return $this->lists($request->all());
            break;
            default : 
            return inertia('Modules/Inventory/Products/Index');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('products')->where(function ($query) use ($request) {
                    return $query->where('brand', $request->brand);
                }),
            ],
            'brand' => 'required',
            'pricing_id' => 'required',
            'percentage_id' => 'required',
            'size' => 'required',
            'price' => 'required',
            'demand' => 'required|integer|min:1',
            'lead' => 'required|integer|min:1',
            'safety' => 'required|integer|min:1'
            
        ]);

        $data = \DB::transaction(function () use ($request){
            if($request->editable){
                $data = Product::where('id',$request->id)->first();
                $data->update($request->except('editable'));
                return $data;
            }else{
                $reorder = 0;
                if($request->demand != null && $request->lead != null && $request->safety != null){
                    $demand = $request->demand;
                    $lead = $request->lead;
                    $safety = $request->safety;

                    $ss =$safety/100 * $demand;
                    $ld = $demand*$lead;

                    $reorder = $ld + $ss;
                }

                $code = 'PRDCT'.date('Y').date('m').date('d')."-".str_pad((Product::count()+1), 4, '0', STR_PAD_LEFT);  
                $data = Product::create(array_merge($request->all(),['code' => $code,'reorder' => $reorder]));
                if($data){
                    $p = new ProductPrice;
                    $p->price = $request->price;
                    $p->product_id = $data->id;
                    $p->is_active = 1;
                    $p->save();
                }
                return $data;
            }
            
        });

        return back()->with([
            'message' => 'Product updated successfully. Thanks',
            'data' => new ItemResource($data),
            'type' => 'bxs-check-circle',
            'color' => 'success'
        ]); 
    }

    public function lists($request){
        $category = $request['category'];
        $keyword = $request['keyword'];
        $is_available = $request['is_available'];

        $data = ItemResource::collection(
            Product::when($keyword, function ($query, $keyword) {
                $query->where('name', 'LIKE', '%'.$keyword.'%');
            })
            ->when($is_available, function ($query, $is_available) {
                $query->where('is_active', $is_available);
            })
            ->whereHas('category',function ($query) use ($category) {
                $query->when($category, function ($query, $category) {
                    $query->where('id',$category);
                });
            })
            ->with('category','orders.status','sales','discounts','percentage')
            ->orderBy('updated_at','desc')
            ->paginate(10)
            ->withQueryString()
        );
        return $data;
    }

    public function update(Request $request){
        if($request->type == 'adjustment'){

            $validated = $request->validate([
                'reason' => 'required',
                'quantity' => 'required|integer|min:1'
            ]);

            $prod = ProductAdjustment::create(array_merge($request->all(),['managed_by' => \Auth::user()->id]));
            if($prod){
                $data = Product::where('id',$request->product_id)->first();
                $data->stock = $data->stock - $request->quantity;
                $data->save();
            }
        }else if($request->type == 'price'){
            $data = Product::where('id',$request->id)->first();
            $data->price = $request->price;
            if($data->save()){
                $u = ProductPrice::where('product_id',$request->id)->update(['is_active' => 0]);

                $p = new ProductPrice;
                $p->price = $request->price;
                $p->product_id = $request->id;
                $p->is_active = 1;
                $p->save();
            }

        }else{
            $data = Product::where('id',$request->id)->update($request->except('id','type'));
            $data = Product::where('id',$request->id)->first();
        }
    
        return back()->with([
            'message' => 'Product status updated successfully. Thanks',
            'data' => new ItemResource($data),
            'type' => 'bxs-check-circle',
            'color' => 'success'
        ]); 
    }
}
