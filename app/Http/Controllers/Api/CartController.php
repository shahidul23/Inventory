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
        $data = new Pos;
        $data->pro_id = $id;
        $data->pro_name= $product->product_name;
        $data->pro_qty = 1;
        $data->pro_price = $product->selling_price;
        $data->sub_total = $product->selling_price;
        $data->save();
        return response()->json("done");
    }
    public function allCartProduce()
    {
        $product = Pos::all();
        return response()->json($product);
    }
}
