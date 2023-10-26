<?php

namespace App\Http\Controllers\Auth;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Title;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\AdminCode;
use DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $employees = Employee::all();
        return view('auth.register', compact('employees'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'employee_id' => 'required',
        ]);

        $employee = Employee::findOrFail($request->employee_id);

        // check title from selected employee
        $title = Title::findOrFail($employee->title_id);
        $isSupervisor = in_array($title->title_name, ['Supervisor', 'Manager', 'Director']);
        Auth::login($user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'employee_id' => $request->employee_id,
        ]));

        $user->level = $isSupervisor ? 'supervisor' : 'employee';
        $user->save();
        // dd($user->level);

       event(new Registered($user));

       return redirect(RouteServiceProvider::HOME);
    }
}
