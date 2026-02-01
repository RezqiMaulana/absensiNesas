<?php

namespace App\Http\Controllers\piket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Building;


class DashboardController extends Controller
{
   public function index(Request $request)
    {
        $today = now()->format('Y-m-d');
        
        // 1. Ambil data gedung/area dengan perhitungan statistik yang akurat
        $areas = Building::with(['classrooms.students'])->get()->map(function($building) use ($today) {
            
            // Hitung total semua siswa yang terdaftar di gedung ini (semua kelas)
            $totalStudents = $building->classrooms->reduce(function ($carry, $classroom) {
                return $carry + $classroom->students->count();
            }, 0);

            // Hitung jumlah siswa yang hadir (status: hadir) di gedung ini pada hari ini
            $presentCount = Attendance::whereHas('student.classroom', function($q) use ($building) {
                $q->where('building_id', $building->id);
            })
            ->whereDate('date', $today)
            ->where('status', 'hadir')
            ->count();

            // Hitung persentase kehadiran
            $percentage = $totalStudents > 0 ? round(($presentCount / $totalStudents) * 100) : 0;

            // Pasang data ke object building untuk digunakan di view
            $building->total_students = $totalStudents;
            $building->present_count = $presentCount;
            $building->percentage = $percentage;

            return $building;
        });

        // 2. Query untuk tabel monitoring (Log aktivitas absensi terbaru)
        $query = Attendance::with(['student.classroom.building', 'submitter'])
            ->whereDate('date', $today);

        // Filter Pencarian Nama Siswa
        if ($request->filled('search')) {
            $query->whereHas('student', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // Filter Berdasarkan Area Gedung
        if ($request->filled('building_id')) {
            $query->whereHas('student.classroom', function($q) use ($request) {
                $q->where('building_id', $request->building_id);
            });
        }

        // Eksekusi query dengan pagination
        $attendances = $query->latest()->paginate(15)->withQueryString();

        return view('piket.dashboard.index', compact('areas', 'attendances', 'today'));
    }
}
