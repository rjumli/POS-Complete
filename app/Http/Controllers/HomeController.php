<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sale;
use App\Models\SaleList;
use App\Models\Dropdown;
use App\Models\ItemDiscount;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;
use App\Http\Resources\ItemDiscountResource;

class HomeController extends Controller
{
    public function index(Request $request){
        ItemDiscount::where('is_active',0)->whereDate('start',now())->update(['is_active' => 1]);
        ItemDiscount::where('is_active',1)->whereDate('end',now())->update(['is_active' => 0]);
        $options = $request->options;
        switch($options){
            case 'lists':
               return $this->lists($request);
            break;
            default : 
            return inertia('Modules/Home/Index',[
                'breakdown' => $this->breakdown(),
                'items' => ItemDiscountResource::collection(ItemDiscount::with('product','package','type','discount.subtype')->where('is_active',1)->get())
            ]);
        }
        // return inertia('Modules/Sales/Index');
    }

    public function lists($request){
        $current_year = $request->year; $years = []; 
        $programs = ['total','tax','discount'];
        $p = ['Total Earnings','Total Tax','Total Discount'];
        foreach($programs as $index => $program){
            $data = []; $year = $current_year - 20;
            for($year; $year <= $current_year; $year++){
                $years[] = $year;
                $data[] = Sale::whereYear('created_at',$year)->sum($program);
            }
            $arr[] = [
                'name' => $p[$index],
                'data' => $data  
            ];
        }
        return $y =[
            'categories' => $years,
            'programs' => ['Total Earnings','Total Tax','Total Discount'],
            'lists' => $arr
        ];
    }   

    public function breakdown(){
        $statuses = Dropdown::where('classification','Status')->where('type','Sale')->get();
        foreach($statuses as $status){
            $arr[] = [
                'name' => $status->name,
                'color' => $status->others,
                'count' => Sale::where('status_id',$status->id)->count()
            ];
        }

        $statuses2 = Dropdown::where('classification','Status')->where('type','Salelist')->get();
        foreach($statuses2 as $status){
            $arr2[] = [
                'name' => $status->name,
                'color' => $status->others,
                'count' => Salelist::where('status_id',$status->id)->count()
            ];
        }
        return [
            'sales' => $arr,
            'salelists' => $arr2
        ];
    }

    public function store(Request $request){
        $request->validate([
            'item_id' => 'sometimes|required',
            'discount_id' => 'sometimes|required',
            'start' => 'sometimes|required',
            'end' => 'sometimes|required_if:type_id,30',
            'type_id' => 'sometimes|required',
        ]);

        $data = \DB::transaction(function () use ($request){
            if($request->editable == 'true'){
                $data = ItemDiscount::where('id',$request->id)->first();
                $data->update($request->except('editable'));
                return $data;
            }else{
                if($request->subtype == 'Product'){
                    $request['product_id'] = $request->item_id;
                    ItemDiscount::where('product_id',$request->item_id)->update(['is_active'=> 0]);
                }else{
                    $request['package_id'] = $request->item_id;
                    ItemDiscount::where('package_id',$request->item_id)->update(['is_active'=> 0]);
                }
                if($request->type_id == 29){
                    $request['end'] = $request->start;
                }
                return $data = ItemDiscount::create($request->all());
            }
            
        });
        $message = ($request->editable) ? 'updated' : 'created';
        return back()->with([
            'message' => 'Discount '.$message.' successfully. Thanks',
            'data' => new DefaultResource($data),
            'type' => 'bxs-check-circle',
            'color' => 'success'
        ]); 
    }

    public function update(Request $request){

        $validatedData = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:9|confirmed',
            'password_confirmation' => 'same:password',
        ]);

        $id = ($request->id) ? $request->id : \Auth::user()->id;

        User::find($id)->update(['password'=> \Hash::make($request->input('password'))]);

        return back()->with([
            'message' => 'Password Changed',
            'data' => 'wew',
            'type' => 'bxs-check-circle'
        ]); 
        
    }
}
