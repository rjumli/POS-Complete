<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class PricingController extends Controller
{
    public function index(Request $request){
        $options = $request->options;
        switch($options){
            case 'lists':
               return $this->lists($request);
            break;
            default : 
            return inertia('Modules/Maintenance/Pricings/Index');
        }
    }

    public function store(Request $request){

        $request->validate([
            'percentage' => 'sometimes|required',
        ]);

        $data = \DB::transaction(function () use ($request){
            if($request->editable == 'true'){
                $data = Pricing::where('id',$request->id)->first();
                $data->update($request->except('editable'));
                return $data;
            }else{
                return $data = Pricing::create(array_merge($request->all(),['added_by' => \Auth::user()->id]));
            }
            
        });
        $message = ($request->editable) ? 'updated' : 'created';
        return back()->with([
            'message' => 'Pricing '.$message.' successfully. Thanks',
            'data' => new DefaultResource($data),
            'type' => 'bxs-check-circle',
            'color' => 'success'
        ]); 
    }

    public function lists($request){
        $data = DefaultResource::collection(
            Pricing::when($request->keyword, function ($query, $keyword) {
                $query->where('percentage', 'LIKE', '%'.$keyword.'%');
            })
            ->with('user')
            ->orderBy('id','desc')
            ->paginate(10)
            ->withQueryString()
        );
        return $data;
    }
}
