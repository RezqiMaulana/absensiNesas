<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Building;
use App\Models\Classroom;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Gedung (2 Area)
        $gedungA = Building::create(['name' => 'Gedung Utara', 'area' => 'Kampus Depan']);
        $gedungB = Building::create(['name' => 'Gedung Selatan', 'area' => 'Kampus Belakang']);

        // 2. Buat Kelas
        $kelas12 = Classroom::create(['name' => 'XII RPL 1', 'building_id' => $gedungA->id]);

        // 3. Buat Akun Admin
        User::create([
            'name' => 'Super Admin',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 4. Buat Akun Piket
        User::create([
            'name' => 'Petugas Piket',
             'username' => 'piket',
            'password' => Hash::make('password'),
            'role' => 'piket',
        ]);

        // 5. Buat Akun Wali Kelas
        User::create([
            'name' => 'Budi Santoso (Wali)',
             'username' => 'walas',
            'password' => Hash::make('password'),
            'role' => 'wali_kelas',
            'classroom_id' => $kelas12->id,
        ]);

        // 6. Buat Akun Perwakilan Siswa
        User::create([
            'name' => 'Andi (Ketua Kelas)',
             'username' => 'siswa',
            'password' => Hash::make('password'),
            'role' => 'perwakilan_siswa',
            'classroom_id' => $kelas12->id,
        ]);
    }
}
