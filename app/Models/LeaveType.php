<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    
    protected $table = "leave_type";
        use HasFactory;

    protected $fillable = ['leave_name', 'document', 'deduct_leave','deduct_long_leave'];
}
