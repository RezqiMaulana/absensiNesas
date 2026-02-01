<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Attendance;
use App\Models\Building;


class Rekapcontroller extends Controller
{
    public function index(Request $request)
    {
        $buildings = Building::all();
        $query = Attendance::with(['student.classroom.building'])->latest('date');

        // Filter logic
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }
        if ($request->filled('building_id')) {
            $query->whereHas('student.classroom', function($q) use ($request) {
                $q->where('building_id', $request->building_id);
            });
        }

        $history = $query->paginate(20)->withQueryString();
        return view('rekap.index', compact('history', 'buildings'));
    }

    public function store(Request $request)
    {
        $filters = $request->only(['start_date', 'end_date', 'building_id']);
        return Excel::download(new AttendanceExport($filters), 'rekap-kehadiran-' . now()->format('Y-m-d') . '.xlsx');
    }
}
