<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use App\Models\LeaveType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $user = Auth::user();
    $leaveRequests = LeaveRequest::with(['employee', 'leaveType'])->get();

    // Calculate used leave and used long leave for the user
    $usedLeave = DB::table('leave_requests')
        ->where('employee_id', $user->employee_id)
        ->where('approved_by_supervisor', 1)
        ->where('approved_by_hr', 1)
        ->whereIn('leave_id', function ($query) {
            $query->select('id')
                ->from('leave_type')
                ->where('deduct_leave', 1);
        })
        ->sum('many_days');

    $usedLongLeave = DB::table('leave_requests')
        ->where('employee_id', $user->employee_id)
        ->where('approved_by_supervisor', 1)
        ->where('approved_by_hr', 1)
        ->whereIn('leave_id', function ($query) {
            $query->select('id')
                ->from('leave_type')
                ->where('deduct_long_leave', 1);
        })
        ->sum('many_days');

    return view('leave-request.index', compact('leaveRequests', 'user', 'usedLeave', 'usedLongLeave'));
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Fetch leave types from the database
        $leaveTypes = LeaveType::all();

        return view('leave-request.create', compact('leaveTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           // Validate the form data
           $validatedData = $request->validate([
            'employee_id' => 'required|numeric',
            'leave_id' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'document' => 'nullable|mimes:pdf,doc,docx',
            'reason' => 'required|string', // Menambahkan validasi untuk Reason
            
        ]);

        // Calculate many_days
        $startDate = \Carbon\Carbon::parse($validatedData['start_date']);
        $endDate = \Carbon\Carbon::parse($validatedData['end_date']);
        $validatedData['many_days'] = $startDate->diffInDaysFiltered(function ($date) {
            return !$date->isWeekend();
        }, $endDate) + 1; // Add 1 to include the end date

        // Check if the selected leave type requires a document
        $leaveType = LeaveType::find($request->leave_id);

        if ($leaveType && $leaveType->document && !$request->hasFile('document')) {
            return redirect()->back()->with('error', 'Document is prohibited for this Leave Type');
        }
        // Upload document if required
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('public/documents');
            // Simpan path dokumen yang diunggah ke dalam database
            $validatedData['document'] = $documentPath;
        }

        // Save the leave request
        LeaveRequest::create($validatedData);

        return redirect('/leave-request')->with('success', 'Leave request submitted successfully!');
    
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
    // // Temukan permintaan cuti berdasarkan ID
    // $leaveRequest = LeaveRequest::findOrFail($id);
    // $leaveTypes = LeaveType::all(); // Menambahkan ini untuk mengambil semua jenis izin

    // // Periksa apakah pengguna saat ini adalah pemilik permintaan cuti atau memiliki peran yang sesuai
    // if (Auth::user()->can('update', $leaveRequest)) {
    //     // Pengguna memiliki izin untuk mengedit permintaan cuti ini
    //     return view('leave-request.edit', compact('leaveRequest','leaveTypes'));
    // } else {
    //     // Pengguna tidak diizinkan mengedit permintaan cuti ini, alihkan atau berikan pesan kesalahan
    //     return redirect()->route('leave-request.index')->with('error', 'You are not authorized to edit this leave request.');
    // }
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
{
    // Mendapatkan daftar ID Leave Request yang telah dicentang oleh supervisor
    $approvedBySupervisor = $request->input('approved_by_supervisor', []);

    // Mendapatkan daftar ID Leave Request yang telah dicentang oleh admin
    $approvedByHR = $request->input('approved_by_hr', []);

    // Mendapatkan semua Leave Request yang perlu diperbarui
    $leaveRequests = LeaveRequest::whereIn('id', array_merge($approvedBySupervisor, $approvedByHR))->get();

    // Loop melalui Leave Request dan perbarui statusnya berdasarkan peran pengguna
    foreach ($leaveRequests as $leaveRequest) {
        if (Auth::user()->level === 'supervisor') {
            // Jika pengguna adalah supervisor, perbarui status "approved_by_supervisor"
            $leaveRequest->approved_by_supervisor = in_array($leaveRequest->id, $approvedBySupervisor);
        }

        if (Auth::user()->level === 'admin') {
            // Jika pengguna adalah admin, perbarui status "approved_by_hr"
            $leaveRequest->approved_by_hr = in_array($leaveRequest->id, $approvedByHR);
        }

        // Simpan perubahan pada Leave Request
        $leaveRequest->save();

        // Update "used_leave" dan "used_long_leave" di tabel "employee" jika leave request telah disetujui
        if ($leaveRequest->approved_by_supervisor && $leaveRequest->approved_by_hr) {
            $employee = $leaveRequest->employee;
            $leaveType = $leaveRequest->leaveType;

            if ($leaveType->deduct_leave) {
                $employee->used_leave += $leaveRequest->many_days;
            }

            if ($leaveType->deduct_long_leave) {
                $employee->used_long_leave += $leaveRequest->many_days;
            }

            // Simpan perubahan pada kolom "used_leave" dan "used_long_leave" di tabel "employee"
            $employee->save();
        }
    }

    return redirect('/leave-request')->with('success', 'Leave requests updated successfully!');
}


    /**
     * Remove the9 specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->delete();

        return redirect('/leave-request')->with('success', 'Leave Request deleted successfully.');
  
    }

    /**
     * Summary of submit
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function submit(Request $request)
    {
        // Anda bisa menggunakan $request untuk memproses data formulir yang dikirim

        return redirect('/leave-request')->with('success', 'Leave request submitted successfully!');
    }
    }
