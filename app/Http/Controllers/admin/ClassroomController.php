<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\classroom\StoreClassroomRequest;
use App\Http\Requests\Admin\classroom\UpdateClassroomRequest;
use App\Imports\ClassroomsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\classroom;
use App\Models\building;

class ClassroomController extends Controller
{
    public function index(Request $request)
    {
        $query = classroom::with('building')->select('classrooms.*');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('building_id')) {
            $query->where('building_id', $request->building_id);
        }

        $classrooms = $query->latest()->paginate(10)->withQueryString();
        $buildings = building::pluck('name', 'id');

        return view('admin.classes.index', compact('classrooms', 'buildings'));
    }

    public function create()
    {
        $buildings = building::pluck('name', 'id');
        return view('admin.classes.create', compact('buildings'));
    }

    public function store(StoreClassroomRequest $request)
    {
        $data = $request->validated();
        classroom::create($data);

        return redirect()->route('admin.classes.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function edit(classroom $classroom)
    {
        $buildings = building::pluck('name', 'id');
        return view('admin.classes.edit', compact('classroom', 'buildings'));
    }

    public function update(UpdateClassroomRequest $request, classroom $classroom)
    {
        $data = $request->validated();
        $classroom->update($data);

        return redirect()->route('admin.classes.index')->with('success', 'Kelas diperbarui.');
    }

    public function destroy(classroom $classroom)
    {
        $classroom->delete();
        return redirect()->back()->with('success', 'Kelas dihapus.');
    }

    public function importcreated()
    {
        return view('admin.classes.import');
    }

    public function exportTemplate()
    {
        $header = [
            ['name', 'building_id'],
            ['Contoh Kelas A', 1],
        ];

        return Excel::download(new class($header) implements \Maatwebsite\Excel\Concerns\FromArray {
            protected $data;
            public function __construct($data) { $this->data = $data; }
            public function array(): array { return $this->data; }
        }, 'template_classroom.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048'
        ]);

        try {
            Excel::import(new ClassroomsImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data kelas berhasil diimpor!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['file' => 'Terjadi kesalahan saat impor: ' . $e->getMessage()]);
        }
    }
}

