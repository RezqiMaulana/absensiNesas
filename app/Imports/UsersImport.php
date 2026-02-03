<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name'     => $row['nama'], // Sesuaikan dengan header di Excel
            'username' => $row['username'],
            'role'     => $row['role'],
            'classroom_id' => $row['class_id'] ?? null,
            'password' => Hash::make($row['password'] ?? 'password123'),
        ]);
    }
}
