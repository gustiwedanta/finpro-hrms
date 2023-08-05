<?php

namespace App\Http\Controllers;

use App\Imports\EmployeeImport;
use Illuminate\Http\Request;
use DB;
use File;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Title;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    public function index()
{
    $employees = Employee::with('department', 'title')->get();

    // Calculate work duration for each employee
    foreach ($employees as $employee) {
        $joinDate = Carbon::createFromFormat('Y-m-d', $employee->join_date);
        $workDuration = $joinDate->diffForHumans(['parts' => 3]);
        $employee->workDuration = $workDuration;
    }

    return view ('employee.index', compact('employees'));
}
    
    public function remainLeave()
    {
        $employees = Employee::select('id', 'nik', 'full_name', 'department_id', 'annual_leave', 'long_leave', 'carry_over', 'join_date')->get();

        $today = Carbon::today();

        foreach ($employees as $employee) {
            $joinDate = Carbon::createFromFormat('Y-m-d', $employee->join_date);
           

            $monthsDiff = $joinDate->diffInMonths($today);

            if ($monthsDiff < 3) {
                $employee->annual_leave = 0;
            } else {
                $employee->annual_leave = min($monthsDiff, 8);
            }

            if ($today->month === 1 && $today->day === 1) {
                $employee->carry_over = $employee->annual_leave;
            }

            $joinYear = $joinDate->year;
            $currentYear = $today->year;
            $yearsDiff = $currentYear - $joinYear;

            if ($yearsDiff === 6) {
                $employee->long_leave = 10;
            } elseif ($yearsDiff > 6) {
                $employee->long_leave = 10 + 10;
            } else {
                $employee->long_leave = 0;
            }

            $employee->save();

        }   

        return view('employee.remain-leave', compact('employees'));
    }

    public function create()
    {
        $departments = Department::all();
        $titles = Title::all();

        return view('employee.create', compact('departments', 'titles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'required|unique:employees',
            'full_name' => 'required',
            'department_id' => 'required',
            'title_id' => 'required',
            'join_date' => 'required',
        ]);

        $employee = new Employee();
        $employee->nik = $request->nik;
        $employee->full_name = $request->full_name;
        $employee->department_id = $request->department_id;
        $employee->title_id = $request->title_id;
        $employee->join_date = $request->join_date;
        $employee->save();

        return redirect('/employee')->with('success', 'Employee created successfully.');
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);

        return view('employee.show', compact('employee'));
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $titles = Title::all();

        return view('employee.edit', compact('employee', 'departments', 'titles'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nik' => 'required|unique:employees,nik,' . $id,
            'full_name' => 'required',
            'department_id' => 'required',
            'title_id' => 'required',
            'join_date' => 'required',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->nik = $request->nik;
        $employee->full_name = $request->full_name;
        $employee->department_id = $request->department_id;
        $employee->title_id = $request->title_id;
        $employee->join_date = $request->join_date;
        $employee->save();

        return redirect('/employee')->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect('/employee')->with('success', 'Employee deleted successfully.');
    }

    public function importexcel(Request $request){
        $data = $request->file('file');

        $filename = $data->getClientOriginalName();
        $data->move('EmployeeData', $filename);

        Excel::import(new EmployeeImport, \public_path('/EmployeeData/'.$filename));
        return \redirect()->back();
    }
}





