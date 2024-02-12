<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RoleMenu;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Resources\RoleResource;

class RoleController extends Controller
{
    public function index(Request $request){
       return inertia('Modules/Utility/Roles/Index',[
            'cashiers' => RoleResource::collection(RoleMenu::with('menu')->where('role_id',3)->get()),
            'owners' => RoleResource::collection(RoleMenu::with('menu')->where('role_id',2)->get()),
            'assistants' => RoleResource::collection(RoleMenu::with('menu')->where('role_id',4)->get()),
            'inventories' => RoleResource::collection(RoleMenu::with('menu')->where('role_id',5)->get())
       ]);
    }

    public function store(Request $request){
        $role = $request->role;
        $menus = $request->menus;

        $arrayOfIds = array_map(function($item) {
            return $item['id'];
        }, $menus);

        if($role == 'Owner'){
            $role = Role::find(2);
            $role->menus()->sync($arrayOfIds);
        }else if($role == 'Cashier'){
            $role = Role::find(3);
            $role->menus()->sync($arrayOfIds);
        }else if($role == 'Assistant Clerk'){
            $role = Role::find(4);
            $role->menus()->sync($arrayOfIds);
        }else{
            $role = Role::find(5);
            $role->menus()->sync($arrayOfIds);
        }
    }
}
