<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Building;

class DashboardController extends Controller
{
    public function index()
    {
       $data = [
            'total_siswa'   => Student::count(),
            'total_user'    => User::count(),
            'total_kelas'   => Classroom::count(),
            'total_gedung'  => Building::count(),
            'area_stats'    => Building::withCount('classrooms')->get()
        ];
        return view('admin.dashboard.index', $data);
    }
    //
}
