<?php

namespace App\Http\Controllers\kelas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Pastikan user memiliki kelas
        if (!$user->classroom_id) {
            return redirect()->back()->with('error', 'Akun Anda tidak terhubung dengan kelas manapun.');
        }

        // Ambil daftar siswa di kelas tersebut
        $students = Student::where('classroom_id', $user->classroom_id)
            ->orderBy('name', 'asc')
            ->get();

        // return view('attendance.form', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa' => 'required|array',
            'siswa.*' => 'required|in:hadir,sakit,izin,alpa',
        ]);

        foreach ($request->siswa as $studentId => $status) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'date' => now()->format('Y-m-d'),
                ],
                [
                    'submitted_by' => Auth::id(),
                    'status' => $status,
                ]
            );
        }

        return redirect()->back()->with('success', 'Absensi berhasil disimpan!');
    }
}
