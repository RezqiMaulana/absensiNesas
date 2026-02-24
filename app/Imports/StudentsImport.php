<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'nis'     => $row['nis'],
            'nisn'    => $row['nisn'],
            'rfid_number' => $row['rfid_number'] ?? null,
            'name'    => $row['name'],
            'classroom_id' => $row['classroom_id'],
        ]);
    }
}
