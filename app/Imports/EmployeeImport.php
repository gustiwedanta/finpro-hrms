<?php

namespace App\Imports;

use App\Employee;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeeImport implements ToModel
{
    /**
    * @param array $col
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $col)
    {
        $joinDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($col[5])->format('Y-m-d');

        return new \App\Models\Employee([
            'nik' => $col [1],
            'full_name' => $col [2],
            'department_id' => $col [3],
            'title_id' => $col [4],
            'join_date' => $joinDate
        ]);
    }
}
