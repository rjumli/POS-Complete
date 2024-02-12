<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SaleList;
use App\Models\SaleListReturn;
use App\Models\SupplierListReturn;
use App\Models\ProductAdjustment;
use App\Models\OrderList;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request){
        $monday =  date("Y-m-d", strtotime("this week monday"));
        $sunday = date("Y-m-d", strtotime("this week sunday"));        
        $type = $request->type;
        switch($type){
            case 'sales':
                $subtype = $request->subtype;
                if($subtype == 'lists'){
                    $date = $request->date;
                    $d = (explode("to", $date));
                    $monday = str_replace(' ','',$d[0]);
                    $sunday = str_replace(' ','',$d[1]);
                    $monday =  date("Y-m-d", strtotime($monday));
                    $sunday = date("Y-m-d", strtotime($sunday));    

                    $sales = SaleList::with('product','package','sale.customer','sale.user')->whereBetween('created_at', [$monday, $sunday])->where('status_id',27)->get();
                    
                    $lists = [];
                    if(count($sales) > 0){
                        foreach($sales as $sale){
                            $lists[] = [
                                'product' => ($sale['product']) ? $sale['product']['name'] : $sale['package']['name'] ,
                                'type' => 'Sold',
                                'quantity' => $sale['quantity'],
                                'price'=> $sale['price'],
                                'total'=> $sale['total'],
                                'customer' => $sale['sale']['customer']['name'],
                                'cashier' => $sale['sale']['user']['name'],
                                'date' => $sale['created_at']
                            ];
                        }
                    }
                    return $lists;
                }else{
                    return inertia('Modules/Reports/Sale',['d' => $monday.' to '.$sunday]);
                }
            break;
            case 'orders':
                $subtype = $request->subtype;
                if($subtype == 'lists'){
                    $date = $request->date;
                    $d = (explode("to", $date));
                    $monday = str_replace(' ','',$d[0]);
                    $sunday = str_replace(' ','',$d[1]);
                    $monday =  date("Y-m-d", strtotime($monday));
                    $sunday = date("Y-m-d", strtotime($sunday));    

                    $orders = OrderList::with('product')->with('order.supplier.supplier')->whereBetween('created_at', [$monday, $sunday])->whereIn('status_id',[8,32])->get();
                    
                    $lists = [];
                    if(count($orders) > 0){
                        foreach($orders as $order){
                            $lists[] = [
                                'product' => $order['product']['name'],
                                'quantity' => $order['quantity'],
                                'price'=> $order['price'],
                                'total'=> $order['order']['total'],
                                'date' => $order['created_at'],
                                'supplier' => $order['order']['supplier']['supplier']['name'].' - '.$order['order']['supplier']['name'],
                            ];
                        }
                    }
                    return $lists;
                }else{
                    return inertia('Modules/Reports/Order',['d' => $monday.' to '.$sunday]);
                }
            break;
            case 'inventory':
                $subtype = $request->subtype;
                $sort = $request->sort;
                if($subtype == 'lists'){
                    $date = $request->date;
                    $d = (explode("to", $date));
                    $monday = str_replace(' ','',$d[0]);
                    $sunday = str_replace(' ','',$d[1]);
                    $monday =  date("Y-m-d", strtotime($monday));
                    $sunday = date("Y-m-d", strtotime($sunday));    

                    $products = Product::whereBetween($sort, [$monday, $sunday])->get();
                    
                    $lists = [];
                    if(count($products) > 0){
                        foreach($products as $product){
                            $lists[] = [
                                'name' => $product['name'],
                                'code' => $product['code'],
                                'price' => $product['price'],
                                'stock' => $product['stock'],
                                'created_at' => $product['created_at'],
                                'updated_at' => $product['updated_at'],
                            ];
                        }
                    }
                    return $lists;
                }else{
                    return inertia('Modules/Reports/Inventory',['d' => $monday.' to '.$sunday]);
                }
            break;
            case 'adjustments':
                $subtype = $request->subtype;
                if($subtype == 'lists'){
                    $date = $request->date;
                    $d = (explode("to", $date));
                    $monday = str_replace(' ','',$d[0]);
                    $sunday = str_replace(' ','',$d[1]);
                    $monday =  date("Y-m-d", strtotime($monday));
                    $sunday = date("Y-m-d", strtotime($sunday));    

                    $lists = ProductAdjustment::with('product','user')->whereBetween('created_at', [$monday, $sunday])->get();
                    return $lists;
                }else{
                    return inertia('Modules/Reports/Adjustment',['d' => $monday.' to '.$sunday]);
                }
            break;
            case 'customers':
                $subtype = $request->subtype;
                if($subtype == 'lists'){
                    $date = $request->date;
                    $d = (explode("to", $date));
                    $monday = str_replace(' ','',$d[0]);
                    $sunday = str_replace(' ','',$d[1]);
                    $monday =  date("Y-m-d", strtotime($monday));
                    $sunday = date("Y-m-d", strtotime($sunday));    

                    $lists = SaleListReturn::with('salelist.product','salelist.sale.customer','status','user')->whereBetween('created_at', [$monday, $sunday])->get();
                    return $lists;
                }else{
                    return inertia('Modules/Reports/Customer',['d' => $monday.' to '.$sunday]);
                }
            break;
            case 'reorders':
                $subtype = $request->subtype;
                if($subtype == 'lists'){
                    $products = Product::whereColumn('stock', '<', 'reorder')
                    ->get();
                    return $products;
                }else{
                    return inertia('Modules/Reports/Reorder',['d' => $monday.' to '.$sunday]);
                }
            break;
            case 'suppliers':
                $subtype = $request->subtype;
                if($subtype == 'lists'){
                    $date = $request->date;
                    $d = (explode("to", $date));
                    $monday = str_replace(' ','',$d[0]);
                    $sunday = str_replace(' ','',$d[1]);
                    $monday =  date("Y-m-d", strtotime($monday));
                    $sunday = date("Y-m-d", strtotime($sunday));    

                    $lists = SupplierListReturn::with('product','status')->whereBetween('created_at', [$monday, $sunday])->get();
                    return $lists;
                }else{
                    return inertia('Modules/Reports/Supplier',['d' => $monday.' to '.$sunday]);
                }
            break;
            default : 
            return inertia('Modules/Inventory/Packages/Index');
        }
    }


    public function edit($date,Request $request){
       
        $d = (explode("to", $date));
        $monday = str_replace(' ','',$d[0]);
        $sunday = str_replace(' ','',$d[1]);
        $monday =  date("Y-m-d", strtotime($monday));
        $sunday = date("Y-m-d", strtotime($sunday));        

        $sales = SaleList::with('product','package')->whereBetween('created_at', [$monday, $sunday])->where('status_id',27)->get();
        $orders = OrderList::with('product')->whereBetween('created_at', [$monday, $sunday])->where('status_id',8)->get();
        
        $sessions = [];
        if(count($sales) > 0){
            foreach($sales as $sale){
                $sessions[] = [
                    'product' => ($sale['product']) ? $sale['product']['name'] : $sale['package']['name'],
                    'type' => 'Sold',
                    'quantity' => $sale['quantity'],
                    'price'=> $sale['price'],
                    'date' => $sale['created_at']
                ];
            }
        }
        if(count($orders) > 0){
            foreach($orders as $order){
                $sessions[] = [
                    'product' => $order['product']['name'],
                    'type' => 'Restock',
                    'quantity' => $order['quantity'],
                    'price'=> $order['price'],
                    'date' => $order['created_at']
                ];
            }
        }

        $monday2 =  date("F d, y", strtotime("this week monday"));
        $sunday2 = date("F d, y", strtotime("this week sunday"));      

        $array = [
            'sessions' => $sessions,
            'week' => $monday2.' to '.$sunday2
        ];

        $pdf = \PDF::loadView('print.report',$array)->setPaper('a4', 'landscape');
        return $pdf->download('InventoryReport.pdf');
    }


    public function sales($date,Request $request){
       
        $d = (explode("to", $date));
        $monday = str_replace(' ','',$d[0]);
        $sunday = str_replace(' ','',$d[1]);
        $monday =  date("Y-m-d", strtotime($monday));
        $sunday = date("Y-m-d", strtotime($sunday));        

        $sales = SaleList::with('product','package','sale.customer','sale.user')->whereBetween('created_at', [$monday, $sunday])->where('status_id',27)->get();
        
        $sessions = [];
        if(count($sales) > 0){
            foreach($sales as $sale){
                $sessions[] = [
                    'customer'=> $sale['sale']['customer']['name'],
                    'product' => ($sale['product']) ? $sale['product']['name'] : $sale['package']['name'],
                    'type' => 'Sold',
                    'quantity' => $sale['quantity'],
                    'price'=> $sale['price'],
                    'total'=> $sale['total'],
                    'cashier'=> $sale['sale']['user']['name'],
                    'date' => $sale['created_at']
                ];
            }
        }else{
            $sessions = [];
        }

        $monday2 =  date("F d, y", strtotime("this week monday"));
        $sunday2 = date("F d, y", strtotime("this week sunday"));      

        $array = [
            'sessions' => $sessions,
            'week' => $monday2.' to '.$sunday2
        ];

        $pdf = \PDF::loadView('print.sale',$array)->setPaper('a4', 'landscape');
        return $pdf->download('SaleReport.pdf');
    }

    public function orders($date,Request $request){
       
        $d = (explode("to", $date));
        $monday = str_replace(' ','',$d[0]);
        $sunday = str_replace(' ','',$d[1]);
        $monday =  date("Y-m-d", strtotime($monday));
        $sunday = date("Y-m-d", strtotime($sunday));        

        $orders = OrderList::with('product','order.supplier.supplier')->whereBetween('created_at', [$monday, $sunday])->where('status_id',8)->get();
    
        if(count($orders) > 0){
            foreach($orders as $order){
                $sessions[] = [
                    'supplier' => $order['order']['supplier']['supplier']['name'].' - '.$order['order']['supplier']['name'],
                    'product' => $order['product']['name'],
                    'type' => 'Restock',
                    'quantity' => $order['quantity'],
                    'price'=> $order['price'],
                    'total'=> $order['order']['total'],
                    'date' => $order['created_at']
                ];
            }
        }else{
            $sessions = [];
        }

        $monday2 =  date("F d, y", strtotime("this week monday"));
        $sunday2 = date("F d, y", strtotime("this week sunday"));      

        $array = [
            'sessions' => $sessions,
            'week' => $monday2.' to '.$sunday2
        ];

        $pdf = \PDF::loadView('print.order',$array)->setPaper('a4', 'landscape');
        return $pdf->download('OrderReport.pdf');
    }

    public function adjustments($date,Request $request){
       
        $d = (explode("to", $date));
        $monday = str_replace(' ','',$d[0]);
        $sunday = str_replace(' ','',$d[1]);
        $monday =  date("Y-m-d", strtotime($monday));
        $sunday = date("Y-m-d", strtotime($sunday));        

        $lists = ProductAdjustment::with('product')->whereBetween('created_at', [$monday, $sunday])->get();
    
        if(count($lists) > 0){
            foreach($lists as $list){
                $sessions[] = [
                    'product' => $list['product']['name'],
                    'quantity' => $list['quantity'],
                    'reason'=> $list['reason'],
                    'date' => $list['created_at']
                ];
            }
        }else{
            $sessions = [];
        }

        $monday2 =  date("F d, y", strtotime("this week monday"));
        $sunday2 = date("F d, y", strtotime("this week sunday"));      

        $array = [
            'sessions' => $sessions,
            'week' => $monday2.' to '.$sunday2
        ];

        $pdf = \PDF::loadView('print.adjustment',$array)->setPaper('a4', 'landscape');
        return $pdf->download('AdjustmentReport.pdf');
    }

    public function customers($date,Request $request){
       
        $d = (explode("to", $date));
        $monday = str_replace(' ','',$d[0]);
        $sunday = str_replace(' ','',$d[1]);
        $monday =  date("Y-m-d", strtotime($monday));
        $sunday = date("Y-m-d", strtotime($sunday));        

        $lists = SaleListReturn::with('salelist.product','status')->whereBetween('created_at', [$monday, $sunday])->get();
    
        if(count($lists) > 0){
            foreach($lists as $list){
                $sessions[] = [
                    'product' => $list['salelist']['product']['name'],
                    'total' => $list['total'],
                    'reason'=> $list['reason'],
                    'quantity'=> $list['quantity'],
                    'status'=> $list['status']['name'],
                    'date' => $list['created_at']
                ];
            }
        }else{
            $sessions = [];
        }

        $monday2 =  date("F d, y", strtotime("this week monday"));
        $sunday2 = date("F d, y", strtotime("this week sunday"));      

        $array = [
            'sessions' => $sessions,
            'week' => $monday2.' to '.$sunday2
        ];

        $pdf = \PDF::loadView('print.customer',$array)->setPaper('a4', 'landscape');
        return $pdf->download('CustomerReport.pdf');
    }

    public function suppliers($date,Request $request){
       
        $d = (explode("to", $date));
        $monday = str_replace(' ','',$d[0]);
        $sunday = str_replace(' ','',$d[1]);
        $monday =  date("Y-m-d", strtotime($monday));
        $sunday = date("Y-m-d", strtotime($sunday));        

        $lists = SupplierListReturn::with('product','status')->whereBetween('created_at', [$monday, $sunday])->get();
    
        if(count($lists) > 0){
            foreach($lists as $list){
                $sessions[] = [
                    'product' => $list['product']['name'],
                    'total' => $list['total'],
                    'reason'=> $list['reason'],
                    'quantity'=> $list['quantity'],
                    'status'=> $list['status']['name'],
                    'date' => $list['created_at']
                ];
            }
        }else{
            $sessions = [];
        }

        $monday2 =  date("F d, y", strtotime("this week monday"));
        $sunday2 = date("F d, y", strtotime("this week sunday"));      

        $array = [
            'sessions' => $sessions,
            'week' => $monday2.' to '.$sunday2
        ];

        $pdf = \PDF::loadView('print.supplier',$array)->setPaper('a4', 'landscape');
        return $pdf->download('SupplierReport.pdf');
    }

    public function reorders($date,Request $request){
       
        $d = (explode("to", $date));
        $monday = str_replace(' ','',$d[0]);
        $sunday = str_replace(' ','',$d[1]);
        $monday =  date("Y-m-d", strtotime($monday));
        $sunday = date("Y-m-d", strtotime($sunday));        

        $lists = Product::whereColumn('stock', '<', 'reorder')
                    ->get();
    
        if(count($lists) > 0){
            foreach($lists as $list){
                $sessions[] = [
                    'name' => $list['name'],
                    'stock' => $list['stock'],
                    'reorder'=> $list['reorder'],
                    'code'=> $list['code'],
                    'date' => $list['created_at']
                ];
            }
        }else{
            $sessions = [];
        }

        $monday2 =  date("F d, y", strtotime("this week monday"));
        $sunday2 = date("F d, y", strtotime("this week sunday"));      

        $array = [
            'sessions' => $sessions,
            'week' => $monday2.' to '.$sunday2
        ];

        $pdf = \PDF::loadView('print.reorder',$array)->setPaper('a4', 'landscape');
        return $pdf->download('ReorderReport.pdf');
    }

    
}
