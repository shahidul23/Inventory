<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class POSController extends Controller
{
    public function getProduct($id)
    {
        $getproduct = DB::table('products')->where('category_id',$id)->get();
        return response()->json($getproduct);
    }
}
