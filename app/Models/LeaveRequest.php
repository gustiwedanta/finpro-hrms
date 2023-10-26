<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'leave_id',
        'start_date',
        'end_date',
        'many_days',
        'document',
        'reason',
        'approved_by_supervisor',
        'approved_by_hr',
    ];

    // Define relationships
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class, 'leave_id');
    }

}
