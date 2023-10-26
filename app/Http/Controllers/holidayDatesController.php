<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use App\Models\LeaveType;
use App\Models\Employee;
use \Illuminate\Support\Facades\Auth;

class holidayDatesController extends Controller
{
        public function index()
        {  
            // $leaveType = LeaveType::all();
            return view('holiday-dates');
        }
}