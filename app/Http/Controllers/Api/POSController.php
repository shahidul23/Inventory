<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DB;

class POSController extends Controller
{
    public function getProduct($id)
    {
        $getproduct = DB::table('products')->where('category_id',$id)->get();
        return response()->json($getproduct);
    }
    public function OrderDone(Request $request)
    {
        $validated = $request->validate([
        'customer_id' => 'required',
        'payby' => 'required',
        ]);
        $data = array();
        $data['customer_id'] = $request->customer_id;
        $data['qty'] = $request->qty;
        $data['subTotal'] = $request->subTotal;
        $data['vat'] = $request->vat;
        $data['total'] = $request->total;
        $data['pay'] = $request->pay;
        $data['due'] = $request->due;
        $data['payby'] = $request->payby;
        $data['order_day'] = date('d/m/Y');
        $data['order_month'] = date('F');
        $data['order_year'] = date('Y');

        $order_id = DB::table('orders')->insertGetId($data);
        $contents = DB::table('pos')->get();

        $olddata = array();
        foreach ($contents as $content) {
            $olddata['order_id'] = $order_id;
            $olddata['pro_id'] = $content->pro_id;
            $olddata['pro_qty'] = $content->pro_qty;
            $olddata['pro_price'] = $content->pro_price;
            $olddata['sub_total'] = $content->sub_total;
            DB::table('order_details')->insert($olddata);
            DB::table('products')
                ->where('id',$content->pro_id)
                ->update(['product_quantity' => DB::raw('product_quantity -'.$content->pro_qty)]);
        }
        DB::table('pos')->delete();
        return response('done');

    }
    public function todaySell()
    {
        $date = date('d/m/Y');
        $sell = DB::table('orders')->where('order_day',$date)->sum('total');
        return response()->json($sell);
    }
    public function todayIncome()
    {
        $date = date('d/m/Y');
        $income = DB::table('orders')->where('order_day',$date)->sum('pay');
        return response()->json($income);
    }
    public function todayDue()
    {
        $date = date('d/m/Y');
        $due = DB::table('orders')->where('order_day',$date)->sum('due');
        return response()->json($due);
    }
    public function todayExpanse()
    {
        $date = date('d/m/Y');
        $expanse = DB::table('expenses')->where('expanse_date',$date)->sum('amount');
        return response()->json($expanse);
    }
    public function stockOut()
    {
        $product = DB::table('products')->where('product_quantity','<',1)->get();
        return response()->json($product);
    }
}
