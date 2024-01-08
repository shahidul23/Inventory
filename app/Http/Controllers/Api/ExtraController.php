<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Extra;
use Image;
use DB;

class ExtraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $extra = DB::table('extras')->first();
        return response()->json($extra);
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
        'vat' => 'required',
        'phone' => 'required|unique:extras|max:11',
        'email' => 'required|unique:extras|email',
        'address' => 'required',
        ]);
        if ($request->logo) {
            $position = strpos($request->logo, ';'); 
            $sub = substr($request->logo, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;
            $image = Image::make($request->logo)->resize(240, 200);
            $upload_path = 'backend/photo/setting/';
            $image_url = $upload_path.$name;
            $image->save($image_url);

            $setting = new Extra;
            $setting->vat = $request->vat;
            $setting->favicon = $request->favicon;
            $setting->email = $request->email;
            $setting->address = $request->address;
            $setting->phone = $request->phone;
            $setting->logo = $image_url;
            $setting->save();
        }else{
            $setting = new Extra;
            $setting->vat = $request->vat;
            $setting->favicon = $request->favicon;
            $setting->email = $request->email;
            $setting->address = $request->address;
            $setting->phone = $request->phone;
            $setting->save();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
