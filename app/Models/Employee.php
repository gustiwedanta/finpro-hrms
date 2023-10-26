<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\Title;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;

    use SoftDeletes; // Tambahkan ini untuk mengaktifkan "soft delete"


    protected $fillable = ['nik', 'full_name', 'department_id', 'title_id', 'join_date','annual_leave','long_leave','carry_over'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function title()
    {
        return $this->belongsTo(Title::class);
    }
}