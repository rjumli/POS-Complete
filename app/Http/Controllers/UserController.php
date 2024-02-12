<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class UserController extends Controller
{
    public function index(Request $request){
        $options = $request->options;
        switch($options){
            case 'lists':
               return $this->lists($request);
            break;
            default : 
            return inertia('Modules/Utility/Users/Index');
        }
    }

    public function store(Request $request){
        $validated = $request->validate([
            'username' => 'sometimes|required|max:20|unique:users,username,'.$request->id,
            'email' => 'sometimes|required|email|unique:users,email,'.$request->id,
            'name' => 'required',
            'role_id' => 'required'
        ]);
        $data = \DB::transaction(function () use ($request){
            if($request->editable){
                $data = User::where('id',$request->id)->first();
                $data->update($request->except('editable'));
                return $data;
            }else{
                return  $data = User::create(array_merge($request->all(), ['password' => bcrypt($request->password), 'is_active' => 1]));
            }
            
        });
        $message = ($request->editable) ? 'updated' : 'created';
        return back()->with([
            'message' => 'User '.$message.' successfully. Thanks',
            'data' => new DefaultResource($data),
            'type' => 'bxs-check-circle',
            'color' => 'success'
        ]); 
    }

    public function lists($request){
        $data = DefaultResource::collection(
            User::when($request->keyword, function ($query, $keyword) {
                $query->where('name', 'LIKE', '%'.$keyword.'%');
            })
            // ->where('role','!=','Administrator')
            ->with('role')
            ->orderBy('id','asc')
            ->paginate(10)
            ->withQueryString()
        );
        return $data;
    }
}
