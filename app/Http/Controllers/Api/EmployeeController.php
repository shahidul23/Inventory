<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use DataTabls;
use Image;
use DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if ($request->ajax()) {
        //     $imgurl = 'backend/photo';
        //     $employ = Employee::all();
        //     return DataTables::of($employ)
        //     ->addIndexColumn()
        //     ->editColumn('photo', function($row){
        //         return '<img src="'.$row->photo.'" height="40" width="50">';
        //     })
        //     ->editColumn('action', function($row){
        //          $actionbtn = '
        //         <a href="#" class="btn btn-info btn-sm edit"><i class="fas fa-edit"></i></a>
        //         <a href="#" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>';
        //         return $actionbtn;
        //     })
        //     ->rawColumns(['action','photo'])
        //     ->toJson();
        // }
        // return false;
        //return datatables(Employee::all())->addIndexColumn()->toJson();


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
        $employee = DB::table('employees')->where('id',$id)->first();
        return response()->json($employee);
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
        'salary' => 'required',
        'Joining_date' => 'required'
        ]);
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['nid_number'] = $request->nid_number;
        $data['gender'] = $request->gender;
        $data['salary'] = $request->salary;
        $data['Joining_date'] = $request->Joining_date;
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
                $img_get = DB::table('employees')->where('id',$id)->first();
                $done = unlink($img_get->photo);
                DB::table('employees')->where('id',$id)->update($data); 
            }
        }else{
            $oldPhoto = $request->photo;
            $data['photo'] = $request->photo;
            DB::table('employees')->where('id',$id)->update($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employee = DB::table('employees')->where('id',$id)->first();
        $photo = $employee->photo;
        if ($photo) {
            unlink($photo);
            DB::table('employees')->where('id',$id)->delete();
        }else{
            DB::table('employees')->where('id',$id)->delete();
        }
    }
}
