<?php

namespace App\Http\Controllers\piket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\piket\exitpermission\StoreExitPermissionRequest;
use App\Http\Requests\piket\exitpermission\UpdateExitPermissionRequest;
use App\Imports\ExitPermissionsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ExitPermission;
use App\Models\student;
use App\Models\teachers;

class exitpermissionscontroller extends Controller
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

        return view('piket.exit_permissions.index', compact('permissions', 'statuses'));
    }

    public function create()
    {
        $students = student::all();
        $teachers = teachers::all();
        $pikets = \App\Models\User::where('role', 'piket')->get(); // Assuming users with role piket
        return view('piket.exit_permissions.create', compact('students', 'teachers', 'pikets'));
    }

    public function store(StoreExitPermissionRequest $request)
    {
        $data = $request->validated();
        ExitPermission::create($data);

        return redirect()->route('piket.exit_permissions.index')->with('success', 'Izin keluar berhasil ditambahkan.');
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
        return view('piket.exit_permissions.edit', compact('exitPermission', 'students', 'teachers', 'pikets'));
    }

    public function update(UpdateExitPermissionRequest $request, ExitPermission $exitPermission)
    {
        $data = $request->validated();
        $exitPermission->update($data);

        return redirect()->route('piket.exit_permissions.index')->with('success', 'Izin keluar diperbarui.');
    }

    public function destroy(ExitPermission $exitPermission)
    {
        $exitPermission->delete();
        return redirect()->back()->with('success', 'Izin keluar dihapus.');
    }

    public function importcreated()
    {
        return view('piket.exit_permissions.import');
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
