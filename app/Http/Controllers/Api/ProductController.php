<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use DataTabls;
use Image;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = DB::table('products')
        ->join('categories','products.category_id','categories.id')
        ->join('suppliers','products.supplier_id','suppliers.id')
        ->select('categories.category_name','suppliers.name','products.*')
        ->orderBy('products.id','DESC')
        ->get();

        return response()->json($product);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'category_id' => 'required',
        'product_name' => 'required',
        'product_code' => 'required|unique:products',
        'selling_price' => 'required',
        'product_quantity' => 'required',
        'supplier_id' => 'required',
        'root' => 'required',
        'buying_price' => 'required',
        'buying_date' => 'required',
        ]);
        $data = new Product;
        $data->category_id = $request->category_id;
        $data->supplier_id = $request->supplier_id;
        $data->product_name = $request->product_name;
        $data->product_code = $request->product_code;
        $data->root = $request->root;
        $data->buying_price = $request->buying_price;
        $data->selling_price = $request->selling_price;
        $data->buying_date = $request->buying_date;
        $data->product_quantity = $request->product_quantity;
        if ($request->image) {
            $position = strpos($request->image, ';'); 
            $sub = substr($request->image, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;
            $image = Image::make($request->image)->resize(240, 200);
            $upload_path = 'backend/photo/product/';
            $image_url = $upload_path.$name;
            $image->save($image_url);
            $data->image = $image_url;
            $data->save();
        }else{
            $data->save();
        } 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findorfail($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validated = $request->validate([
        'category_id' => 'required',
        'product_name' => 'required',
        'product_code' => 'required',
        'selling_price' => 'required',
        'product_quantity' => 'required',
        'supplier_id' => 'required',
        'root' => 'required',
        'buying_price' => 'required',
        'buying_date' => 'required',
        ]);

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['category_id'] = $request->category_id;
        $data['supplier_id'] = $request->supplier_id;
        $data['selling_price'] = $request->selling_price;
        $data['buying_price'] = $request->buying_price;
        $data['root'] = $request->root;
        $data['buying_date'] = $request->buying_date;
        $data['product_quantity'] = $request->product_quantity;
        if ($request->newphoto) {
            $position = strpos($request->newphoto, ';'); 
            $sub = substr($request->newphoto, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;
            $image = Image::make($request->newphoto)->resize(240, 200);
            $upload_path = 'backend/photo/product/';
            $image_url = $upload_path.$name;
            $success = $image->save($image_url);
            if ($success) {
                $data['image'] = $image_url;
                $img_get = DB::table('products')->where('id',$id)->first();
                $done = unlink($img_get->image);
                DB::table('products')->where('id',$id)->update($data); 
            }
        }else{
            $oldPhoto = $request->image;
            $data['image'] = $oldPhoto;
            DB::table('products')->where('id',$id)->update($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = DB::table('products')->where('id',$id)->first();
        $photo = $product->image;
        if ($photo) {
            unlink($photo);
            DB::table('products')->where('id',$id)->delete();
        }else{
            DB::table('products')->where('id',$id)->delete();
        }
    }
}
