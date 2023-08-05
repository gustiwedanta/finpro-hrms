<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveType;
use App\Models\Employee;

class LeaveTypeController extends Controller
{
    public function index()
    {  
        $LeaveType = LeaveType::all();
        $employee = Employee::all();
        return view('leave-type.index', compact('LeaveType','employee'));
    }


     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leave-type/create');
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
    		'leave_name' => ['required', 'unique:LeaveTypes'],
    	]);
 
        LeaveType::create([
    		'leave_name' => $request->leave_name
    	]);
 
    	return redirect('/leave-type');
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
        $LeaveType = LeaveType::find($id);
        return view('leave-type/edit', compact('LeaveType'));
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
    		'leave_name' => 'required'
        ]);

        $LeaveType = [
            'leave_name' => $request->leave_name,
        ];
        LeaveType::whereId($id)->update($LeaveType);
        return redirect('/leave-type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $LeaveType = LeaveType::findorfail($id);
        $LeaveType->delete();
        return redirect('/department');
    }
}


