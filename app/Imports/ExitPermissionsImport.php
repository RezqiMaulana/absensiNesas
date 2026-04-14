<?php

namespace App\Imports;

use App\Models\ExitPermission;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExitPermissionsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ExitPermission([
            'student_id' => $row['student_id'],
            'teacher_id' => $row['teacher_id'],
            'piket_id' => $row['piket_id'],
            'reason' => $row['reason'],
            'leave_at' => $row['leave_at'],
            'return_at' => $row['return_at'] ?? null,
            'status' => $row['status'] ?? 'pending',
        ]);
    }
}
?>

