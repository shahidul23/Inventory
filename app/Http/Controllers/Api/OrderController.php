<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon;
use DB;

class OrderController extends Controller
{
    public function TodayOeders(){
        $date = date('d/m/Y');
        $order = DB::table('orders')
               ->join('customers', 'orders.customer_id','customers.id')
               ->where('orders.order_day',$date)
               ->select('customers.name','orders.*')
               ->orderBy('orders.id','DESC')
               ->get();
        return response()->json($order);       
    }
    public function OrderDetails($id)
    {
        $order = DB::table('orders')
            ->join('customers','orders.customer_id','customers.id')
            ->where('orders.id',$id)
            ->select('customers.name','customers.phone','customers.address','customers.email','orders.*')
            ->first();
        return response()->json($order);
    }
    public function OrderDetailsAll($id)
    {
        $details = DB::table('order_details')
            ->join('products','order_details.pro_id','products.id')
            ->where('order_details.order_id',$id)
            ->select('products.product_name','products.product_code','products.image','order_details.*')
            ->get();    
        return response()->json($details);
    }
    public function searchOrderDate($date)
    {
        $data = Carbon\Carbon::parse($date)->format('d/m/Y'); 

        $details = DB::table('order_details')
            ->join('products','order_details.pro_id','products.id')
            ->join('orders','order_details.order_id','orders.id')
            ->where('orders.order_day',$data)
            ->select('products.product_name','products.product_code','products.image',
                'orders.order_day','order_details.*')
            ->get();
        return response()->json($details);
    }
    public function searchOrderMonth($month)
    {
        $details = DB::table('order_details')
            ->join('products','order_details.pro_id','products.id')
            ->join('orders','order_details.order_id','orders.id')
            ->where('orders.order_month',$month)
            ->select('products.product_name','products.product_code','products.image',
                'orders.order_day','orders.order_month','order_details.*')
            ->get();
        return response()->json($details);
    }
}
