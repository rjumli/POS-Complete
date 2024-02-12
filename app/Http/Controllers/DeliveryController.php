<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;
use Illuminate\Validation\Rule;

class DeliveryController extends Controller
{
    public function index(Request $request){
        $options = $request->options;
        switch($options){
            case 'lists':
               return $this->lists($request->all());
            break;
            case 'view':
                return $this->view($request->all());
            break;
            default : 
            return inertia('Modules/Stocking/Deliveries/Index');
        }
    }

    public function lists($request){
        $keyword = $request['keyword'];

        $data = DefaultResource::collection(
            Order::with('lists.product','lists.status','status','supplier.supplier')
            ->when($keyword, function ($query, $keyword) {
                $query->where('code', 'LIKE', '%'.$keyword.'%');
            })
            ->whereIn('status_id',[4,31])
            ->orderBy('id','asc')
            ->paginate(10)
            ->withQueryString()
        );
        return $data;
    }
}
