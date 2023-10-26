<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use App\Models\LeaveType;
use App\Models\Employee;
use \Illuminate\Support\Facades\Auth;

class LeaveTypeController extends Controller
{
    public function index()
    {  
        $leaveType = LeaveType::all();
        $employee = Employee::all();
        return view('leave-type.index', compact('leaveType','employee'));
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

    public function store(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'leave_name' => 'required|unique:leave_type',
        'document' => 'nullable|boolean',
        'deduct_leave' => 'nullable|boolean',
        'deduct_long_leave' => 'nullable|boolean',
    ]);

    // Set default values for hidden inputs if they are not provided
    $document = isset($validatedData['document']) ? $validatedData['document'] : false;
    $deductLeave = isset($validatedData['deduct_leave']) ? $validatedData['deduct_leave'] : false;
    $deductLongLeave = isset($validatedData['deduct_long_leave']) ? $validatedData['deduct_long_leave'] : false;

    // Create and save the LeaveType instance
    LeaveType::create([
        'leave_name' => $validatedData['leave_name'],
        'document' => $document,
        'deduct_leave' => $deductLeave,
        'deduct_long_leave' => $deductLongLeave,
    ]);

    // Redirect with a success message if everything goes well
    return redirect('/leave-type')->with('success', 'Leave type created successfully.');
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
        return redirect('/leave-type');
    }
}


