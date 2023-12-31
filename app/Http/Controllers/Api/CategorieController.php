<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
use DB;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Categorie::all();
        return response()->Json($category);
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
        'category_name' => 'required|unique:categories',
        ]);
        $category = new Categorie;
        $category->category_name = $request->category_name;
        $category->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Categorie::findorfail($id);
        return response()->Json($category);
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
        'category_name' => 'required',
        ]);
        $data = array();
        $data['category_name'] = $request->category_name;
        DB::table('categories')->where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('categories')->where('id', $id)->delete();
        return response('delete');
    }
}
