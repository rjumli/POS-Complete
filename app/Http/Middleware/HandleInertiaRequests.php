<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\Order;
use App\Models\Sale;
use App\Models\Unit;
use App\Models\Discount;
use App\Models\Dropdown;
use App\Models\Customer;
use App\Models\SupplierBranch;
use App\Models\Category;
use App\Models\Product;
use App\Models\ItemDiscount;
use App\Models\Pricing;
use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Http\Resources\UserResource;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => (\Auth::check()) ? new UserResource(\Auth::user()) : '',
            'role' => (\Auth::check()) ? \Auth::user()->role->name : '',
            'role_menus' => (\Auth::check()) ? \Auth::user()->role->menus : '',
            'flash' => [
                'message' => session('message'),
                'data' => session('data'),
                'type' => session('type'),
                'color' => session('color')
            ],
            'categories' => Category::all(),
            'suppliers' => SupplierBranch::with('supplier')->where('is_active',1)->get(),
            'units' => Unit::all(),
            'dropdowns' => Dropdown::all(),
            'products' => Product::all(),
            'customers' => Customer::all(),
            'discounts' => Discount::all(),
            'percentages' => Pricing::all(),
            'revenue' => Sale::where('status_id',24)->sum('total'),
            'customer_count' => Customer::count(),
            'stocks' => Product::sum('stock'),
            'orders' => Order::with('lists.product','lists.status','status','supplier.supplier')->where('status_id',4)->get(),
            'sales' =>  Sale::with('lists.product','lists.package','lists.status','payment','discounted','customer','status')->orderBy('id','desc')->limit(5)->get(),
            'active_discounts' => Discount::with('type','subtype','based')->where('is_active',1)->where('type_id',16)->get(),
            'roles' => Role::all()
        ]);
    }
}
