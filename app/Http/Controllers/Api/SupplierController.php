<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use DataTabls;
use Image;
use DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = Supplier::all();
        return response()->json($supplier);
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
        'email' => 'required|unique:suppliers|email',
        'phone' => 'required|unique:suppliers',
        'name' => 'required',
        'address' => 'required',
        'gender' => 'required',
        ]);
        if ($request->photo) {
            $position = strpos($request->photo, ';'); 
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;
            $image = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'backend/photo/';
            $image_url = $upload_path.$name;
            $image->save($image_url);

            $supplier = new Supplier;
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->address = $request->address;
            $supplier->gender = $request->gender;
            $supplier->shopname = $request->shopname;
            $supplier->phone = $request->phone;
            $supplier->photo = $image_url;
            $supplier->save();
        }else{
            $supplier = new Supplier;
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->address = $request->address;
            $supplier->gender = $request->gender;
            $supplier->shopname = $request->shopname;
            $supplier->phone = $request->phone;
            $supplier->save();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = DB::table('suppliers')->where('id',$id)->first();
        return response()->json($supplier);
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
        'email' => 'required|email',
        'phone' => 'required',
        'name' => 'required',
        'address' => 'required',
        'gender' => 'required',
        ]);
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['gender'] = $request->gender;
        $data['shopname'] = $request->shopname;
        $data['phone'] = $request->phone;
        if ($request->newphoto) {
            $position = strpos($request->newphoto, ';'); 
            $sub = substr($request->newphoto, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;
            $image = Image::make($request->newphoto)->resize(240, 200);
            $upload_path = 'backend/photo/';
            $image_url = $upload_path.$name;
            $success = $image->save($image_url);
            if ($success) {
                $data['photo'] = $image_url;
                $img_get = DB::table('suppliers')->where('id',$id)->first();
                $done = unlink($img_get->photo);
                DB::table('suppliers')->where('id',$id)->update($data); 
            }
        }else{
            $oldPhoto = $request->photo;
            $data['photo'] = $oldPhoto
            DB::table('suppliers')->where('id',$id)->update($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = DB::table('suppliers')->where('id',$id)->first();
        $photo = $supplier->photo;
        if ($photo) {
            unlink($photo);
            DB::table('suppliers')->where('id',$id)->delete();
        }else{
            DB::table('suppliers')->where('id',$id)->delete();
        }
    
    }
}
