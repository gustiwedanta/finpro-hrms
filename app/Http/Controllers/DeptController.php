<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Employee;

class DeptController extends Controller
{
    public function index()
    {  
        $department = Department::all();
        $employee = Employee::all();
        return view('department/index', compact('department','employee'));
    }


     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('department/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
    		'dept_name' => ['required', 'unique:Departments'],
    	]);
 
        Department::create([
    		'dept_name' => $request->dept_name
    	]);
 
    	return redirect('/department');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::find($id);
        return view('department/edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
    		'dept_name' => 'required'
        ]);

        $department = [
            'dept_name' => $request->dept_name,
        ];
        Department::whereId($id)->update($department);
        return redirect('/department');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::findorfail($id);
        $department->delete();
        return redirect('/department');
    }
}


