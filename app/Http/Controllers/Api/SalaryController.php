<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary;
use DB;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salary = DB::table('salaries')
        ->join('employees','salaries.employee_id','employees.id')
        ->select('employees.*','salaries.*')
        ->orderBy('salaries.id','DESC')
        ->get();
        return response()->json($salary);
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
    public function paid(Request $request, $id)
    {
        $validated = $request->validate([
        'salary_month' => 'required',
        ]);

        $check = DB::table('salaries')->where('employee_id',$id)->where('salary_month',$request->salary_month)->first();
        if ($check) {
            return response()->json('Salary already paid');
        }else{
            $data = new Salary;
            $data->employee_id = $id;
            $data->amount = $request->salary;
            $data->salary_date = date('d/m/Y');
            $data->salary_month = $request->salary_month;
            $data->salary_year = date('Y');
            $data->save();
        }
    }
    public function store(Request $request,)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $salary = DB::table('salaries')
        ->join('employees','salaries.employee_id','employees.id')
        ->select('employees.*','salaries.*')
        ->where('salaries.id',$id)
        ->first();
        return response()->json($salary);
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
        'salary_month' => 'required',
        ]);

        $check = DB::table('salaries')->where('employee_id',$id)->where('salary_month',$request->salary_month)->first();
        if ($check) {
            return response()->json('Salary already paid');
        }else{
            $data = array();
            $data['salary_month'] = $request->salary_month;
            DB::table('salaries')->where('id',$id)->update($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
