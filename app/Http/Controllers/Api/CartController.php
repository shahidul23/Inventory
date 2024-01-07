<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pos;
use DB;

class CartController extends Controller
{
    public function cartInsert(Request $request , $id)
    {
        $product = DB::table('products')->where('id',$id)->first();

        $check = DB::table('pos')->where('pro_id',$id)->first();
        if ($check) {
            DB::table('pos')->where('pro_id',$id)->increment('pro_qty');
            $cart = DB::table('pos')->where('pro_id',$id)->first();
            $subTotal = $cart->pro_qty * $cart->pro_price;
            DB::table('pos')->where('pro_id',$id)->update(['sub_total' => $subTotal]);
        }else{
            $data = new Pos;
            $data->pro_id = $id;
            $data->pro_name= $product->product_name;
            $data->pro_qty = 1;
            $data->pro_price = $product->selling_price;
            $data->sub_total = $product->selling_price;
            $data->save();
        }
        return response()->json("done");
    }
    public function allCartProduce()
    {
        $product = Pos::all();
        return response()->json($product);
    }
    public function incrementCart($id)
    {
        $quentity = DB::table('pos')->where('id', $id)->increment('pro_qty');

        $product = DB::table('pos')->where('id',$id)->first();
        $subTotal = $product->pro_qty * $product->pro_price;
        DB::table('pos')->where('id',$id)->update(['sub_total' => $subTotal]);
        return response('done');
    }
    public function decrementCart($id)
    {
        $quentity = DB::table('pos')->where('id', $id)->decrement('pro_qty');

        $product = DB::table('pos')->where('id',$id)->first();
        $subTotal = $product->pro_qty * $product->pro_price;
        DB::table('pos')->where('id',$id)->update(['sub_total' => $subTotal]);
        return response('done');
    }
    public function CartProductRemove($id)
    {
        DB::table('pos')->where('id',$id)->delete();
        return response('done');
    }

}
