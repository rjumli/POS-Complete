<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\SupplierBranch;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class SupplierController extends Controller
{
    public function index(Request $request){
        $options = $request->options;
        switch($options){
            case 'lists':
               return $this->lists($request);
            break;
            case 'names':
                return $this->names($request);
             break;
            default : 
            return inertia('Modules/Maintenance/Suppliers/Index');
        }
    }

    public function store(Request $request){

         $request->validate([
            'name' => 'required',
            'contact_person' => 'sometimes|required',
            'contact_number' => 'sometimes|required',
            'address' => 'sometimes|required',
            'email' => 'sometimes|required',
            'supplier_id' => 'sometimes|required',
        ]);

        $data = \DB::transaction(function () use ($request){
            if($request->type == 'name'){
                if($request->editable){
                    $data = Supplier::with('supplier')->where('id',$request->id)->first();
                    $data->update($request->except('editable'));
                    return $data;
                }else{
                    return $data = Supplier::create($request->all());
                }
            }else{
                if($request->editable){
                    $data = SupplierBranch::with('supplier')->where('id',$request->id)->first();
                    $data->update($request->except('editable'));
                    return $data;
                }else{
                    return $data = SupplierBranch::create($request->all());
                }
            }
            
        });
        $message = ($request->editable) ? 'updated' : 'created';
        return back()->with([
            'message' => 'Supplier '.$message.' successfully. Thanks',
            'data' => new DefaultResource($data),
            'type' => 'bxs-check-circle',
            'color' => 'success'
        ]); 
    }

    public function lists($request){
        $data = DefaultResource::collection(
            SupplierBranch::with('supplier')
            ->when($request->keyword, function ($query, $keyword) {
                $query->where('name', 'LIKE', '%'.$keyword.'%');
            })
            ->orderBy('id','asc')
            ->paginate(10)
            ->withQueryString()
        );
        return $data;
    }

    public function names($request){
        $data = DefaultResource::collection(
            Supplier::when($request->keyword, function ($query, $keyword) {
                $query->where('name', 'LIKE', '%'.$keyword.'%');
            })
            ->get()
        );
        return $data;
    }
}
