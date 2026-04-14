<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\exitpermission\StoreExitPermissionRequest;
use App\Http\Requests\Admin\exitpermission\UpdateExitPermissionRequest;
use App\Imports\ExitPermissionsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ExitPermission;
use App\Models\student;
use App\Models\teachers;

class ExitPermissionController extends Controller
{
    public function index(Request $request)
    {
        $query = ExitPermission::with(['student', 'teacher', 'piket']);

        // Pencarian berdasarkan nama siswa atau alasan
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->whereHas('student', function($sub) use ($request) {
                    $sub->where('name', 'like', '%' . $request->search . '%');
                })->orWhere('reason', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $permissions = $query->latest()->paginate(10)->withQueryString();
        $statuses = ['pending', 'approved', 'completed']; // Untuk dropdown filter

        return view('admin.exit-permissions.index', compact('permissions', 'statuses'));
    }

    public function create()
    {
        $students = student::all();
        $teachers = teachers::all();
        $pikets = \App\Models\User::where('role', 'piket')->get(); // Assuming users with role piket
        return view('admin.exit-permissions.create', compact('students', 'teachers', 'pikets'));
    }

    public function store(StoreExitPermissionRequest $request)
    {
        $data = $request->validated();
        ExitPermission::create($data);

        return redirect()->route('admin.exit-permissions.index')->with('success', 'Izin keluar berhasil ditambahkan.');
    }

    public function show(ExitPermission $exitPermission)
    {
        //
    }

    public function edit(ExitPermission $exitPermission)
    {
        $students = student::all();
        $teachers = teachers::all();
        $pikets = \App\Models\User::where('role', 'piket')->get();
        return view('admin.exit-permissions.edit', compact('exitPermission', 'students', 'teachers', 'pikets'));
    }

    public function update(UpdateExitPermissionRequest $request, ExitPermission $exitPermission)
    {
        $data = $request->validated();
        $exitPermission->update($data);

        return redirect()->route('admin.exit-permissions.index')->with('success', 'Izin keluar diperbarui.');
    }

    public function destroy(ExitPermission $exitPermission)
    {
        $exitPermission->delete();
        return redirect()->back()->with('success', 'Izin keluar dihapus.');
    }

    public function importcreated()
    {
        return view('admin.exit-permissions.import');
    }

    public function exportTemplate()
    {
        $header = [
            ['student_id', 'teacher_id', 'piket_id', 'reason', 'leave_at', 'return_at', 'status'],
            ['1', '1', '1', 'Sakit', '10:00', '12:00', 'pending'],
        ];

        return Excel::download(new class($header) implements \Maatwebsite\Excel\Concerns\FromArray {
            protected $data;
            public function __construct($data) { $this->data = $data; }
            public function array(): array { return $this->data; }
        }, 'template_exit_permission.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048'
        ]);

        try {
            Excel::import(new ExitPermissionsImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data izin keluar berhasil diimpor!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['file' => 'Terjadi kesalahan saat impor: ' . $e->getMessage()]);
        }
    }
}
?>

