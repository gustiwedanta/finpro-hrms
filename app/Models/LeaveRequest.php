<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected static function boot()
{
    parent::boot();

    static::created(function ($leaveRequest) {
        $employee = Employee::where('nik', $leaveRequest->nik)->first();

        if ($leaveRequest->leave_id == 1) {
            $employee->calculateAnnualLeave();
        } elseif ($leaveRequest->leave_id == 2) {
            $employee->calculateLongLeave();
        } elseif ($leaveRequest->leave_id == 3) {
            // Logika pengoperan angka cuti dari tahun sebelumnya
        }

        $employee->save();
    });
}

}
