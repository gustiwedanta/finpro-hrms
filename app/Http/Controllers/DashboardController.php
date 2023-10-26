<?php
    namespace App\Http\Controllers;
    use App\Http\Controllers\Controller;
    use App\Models\Employee;
    use App\Models\Department;
    use App\Models\LeaveRequest;
    use App\Models\Title;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Http\Request;


    class DashboardController extends Controller
    {
        public function index()
        {
            $user = Auth::user();
            $role = $user->level;

            switch ($role) {
                case 'admin':
                    $totalOnLeave = LeaveRequest::count();
                    $totalDepartments = Department::count();
                    $totalTitles = Title::count();
                    $leaveNotApproved = LeaveRequest::where('approved_by_supervisor', 0)
                        ->orWhere('approved_by_hr', 0)
                        ->count();
                    $approvedLeaveRequests = LeaveRequest::where('approved_by_supervisor', 1)
                    ->where('approved_by_hr', 1)
                    ->get();

                    return view('/dashboard', compact('totalOnLeave', 'totalDepartments', 'totalTitles', 'leaveNotApproved', 'approvedLeaveRequests'));
                    break;

                case 'supervisor':
                    $employee = $user->employee;
                    $leaveAmount = $employee->annual_leave;
                    $usedLeave = $employee->used_leave;
                    $usedLongLeave = $employee->used_long_leave;
                    
                    $remainingLeave = $employee->annual_leave - $usedLeave;
                    $remainingLongLeave = $employee->long_leave - $usedLongLeave;

                    $employeeDepartment = $employee->department;
                    $leaveRequests = LeaveRequest::whereHas('employee', function ($query) use ($employeeDepartment) {
                        $query->where('department_id', $employeeDepartment->id);
                    })->where('approved_by_supervisor', 0)->count();
                    $approvedLeaveRequests = LeaveRequest::where('approved_by_supervisor', 1)
                    ->where('approved_by_hr', 1)
                    ->get();

                    return view('/dashboard', compact('leaveAmount', 'remainingLeave', 'remainingLongLeave', 'leaveRequests', 'usedLeave', 'usedLongLeave', 'approvedLeaveRequests'));
                    break;

                case 'employee':
                    $employee = $user->employee;
                    $leaveAmount = $employee->remaining_leave + $employee->remaining_long_leave;
                    $usedLeave = $employee->used_leave;
                    $usedLongLeave = $employee->used_long_leave;

                    $remainingLeave = $employee->annual_leave - $usedLeave;
                    $remainingLongLeave = $employee->long_leave - $usedLongLeave;

                    $leaveRequests = LeaveRequest::where('employee_id', $employee->id)->where('approved_by_supervisor', 0)->count();
                    $approvedLeaveRequests = LeaveRequest::where('approved_by_supervisor', 1)
                    ->where('approved_by_hr', 1)
                    ->get();

                    return view('/dashboard', compact('leaveAmount', 'remainingLeave', 'remainingLongLeave', 'leaveRequests'));
                    break;
                
                default:
                    return view('/dashboard');
            }
            
        }
    }
