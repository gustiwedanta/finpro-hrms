<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeptController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\holidayDatesController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\ProposeLeaveController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\TitleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/employee/remain-leave', [EmployeeController::class, 'remainLeave']);

Route::get('/leave-request/create', [LeaveRequestController::class, 'create']);
Route::post('/leave-request/store', [LeaveRequestController::class, 'store'])->name('leave-request.store');
Route::get('/leave-request', [LeaveRequestController::class, 'index']);
Route::put('/leave-request/{id}', [LeaveRequestController::class, 'update'])->name('leave-request.update');
Route::get('/leave-request/submit', [LeaveRequestController::class, 'submit'])->name('leave-request.submit');
Route::post('/leave-request/submit', [LeaveRequestController::class, 'submit']);
Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
Route::get('/dashboard/supervisor', [DashboardController::class, 'supervisor'])->name('dashboard.supervisor');
Route::get('/dashboard/employee', [DashboardController::class, 'employee'])->name('dashboard.employee');

Route::resources([
    'employee' => EmployeeController::class,
    'department' => DeptController::class,
    'title' => TitleController::class,
    'propose-leave' => \App\Http\Controllers\ProposeLeaveController::class,
    'dashboard' => DashboardController::class,
    'leave-type' => LeaveTypeController::class,
    'holiday-dates' => holidayDatesController::class,
    // 'leave-request' => LeaveRequestController::class,
]);

// Untuk custom controller EmployeeController dengan nama rute 'remain-leave'


Route::post('/import', [ImportController::class, 'import'])->name('import');

Route::get('/', function () {
    return view('auth.login');
});

Route::post('/importexcel',[EmployeeController::class, 'importexcel'])->name('importexcel');

// Route::get('/employee', [EmployeeController::class, 'index']);
// Route::get('/employee/create', [EmployeeController::class, 'create']);
// Route::post('/employee', [EmployeeController::class, 'store']);
// Route::get('/employee/{id}/edit', [EmployeeController::class, 'edit']);
// Route::put('/employee/{id}', [EmployeeController::class, 'update']);
// Route::delete('/employee/{id}', [EmployeeController::class, 'destroy']);
// Route::get('/employee/remain-leave', [\App\Http\Controllers\EmployeeController::class, 'remainLeave']);
    
// Route::resources([
//     'title' => TitleController::class,
//     'department' => DeptController::class,
//     'employee' => EmployeeController::class,
//     'propose-leave' => ProposeLeaveController::class,
// ]);

//ini gua cuma buat preview kim, biar muncul
require __DIR__.'/auth.php';

// Controller 

