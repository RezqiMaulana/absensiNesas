<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\Building;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
   public function index()
    {
        // Statistik Utama
        $stats = [
            'total_users'    => User::count(),
            'total_students' => Student::count(),
            'total_buildings'=> Building::count(),
            'present_today'  => Attendance::whereDate('date', now())->where('status', 'hadir')->count(),
        ];

        // Data Grafik: Kehadiran 7 hari terakhir
        $chartData = Attendance::select(DB::raw('DATE(date) as date'), DB::raw('count(*) as aggregate'))
            ->where('date', '>=', now()->subDays(7))
            ->where('status', 'hadir')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        // Aktivitas Terbaru (Eager Loading untuk performa)
        $recentActivities = Attendance::with(['student', 'student.classroom'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact('stats', 'chartData', 'recentActivities'));
    }
    //
}
