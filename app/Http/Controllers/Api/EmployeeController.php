<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee = Employee::all();
        return response()->json($employee);
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
        // dd($request->photo);
        $validated = $request->validate([
        'email' => 'required|unique:employees|email',
        'phone' => 'required|unique:employees',
        'name' => 'required',
        'address' => 'required',
        'gender' => 'required',
        'salary' => 'required',
        'Joining_date' => 'required'
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

            $employee = new Employee;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->nid_number = $request->nid_number;
            $employee->gender = $request->gender;
            $employee->salary = $request->salary;
            $employee->Joining_date = $request->Joining_date;
            $employee->phone = $request->phone;
            $employee->photo = $image_url;
            $employee->save();
        }else{
            $employee = new Employee;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->nid_number = $request->nid_number;
            $employee->gender = $request->gender;
            $employee->salary = $request->salary;
            $employee->Joining_date = $request->Joining_date;
            $employee->phone = $request->phone;
            $employee->save();
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
