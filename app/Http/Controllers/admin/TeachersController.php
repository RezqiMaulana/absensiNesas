<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\teacher\StoreTeacherRequest;
use App\Http\Requests\Admin\teacher\UpdateTeacherRequest;
use App\Imports\TeachersImport;
use Maatwebsite\Excel\Facades\Excel;
=======
use App\Models\teachers;
use App\Models\Classroom;
use Illuminate\Support\Facades\Hash;
>>>>>>> def37a5 (push env)

class TeachersController extends Controller
{
    public function index(Request $request)
    {
<<<<<<< HEAD
        $query = Teacher::query();

        // Pencarian berdasarkan Nama atau NIP
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('nip', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan Mata Pelajaran
        if ($request->filled('subject')) {
            $query->where('subject', $request->subject);
        }

        $teachers = $query->latest()->paginate(10)->withQueryString();
        $subjects = Teacher::distinct()->pluck('subject')->filter()->values(); // Untuk dropdown filter

        return view('admin.teachers.index', compact('teachers', 'subjects'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(StoreTeacherRequest $request)
    {
        $data = $request->validated();
        Teacher::create($data);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher berhasil ditambahkan.');
    }

    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $data = $request->validated();
        $teacher->update($data);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher diperbarui.');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->back()->with('success', 'Teacher dihapus.');
    }

    public function importcreated()
    {
        return view('admin.teachers.import');
    }

    public function exportTemplate()
    {
        // Membuat array untuk header template
        $header = [
            ['nama', 'nip', 'subject'],
            ['Contoh Nama', '123456789', 'Matematika'],
        ];

        return Excel::download(new class($header) implements \Maatwebsite\Excel\Concerns\FromArray {
            protected $data;
            public function __construct($data) { $this->data = $data; }
            public function array(): array { return $this->data; }
        }, 'template_teacher.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048'
        ]);

        try {
            Excel::import(new TeachersImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data teacher berhasil diimpor!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['file' => 'Terjadi kesalahan saat impor: ' . $e->getMessage()]);
        }
    }
}
=======
        $teachers = teachers::latest()->paginate(10);

        // $query = teachers::query();

        // if ($request->filled('search')) {
        //     $query->where( 'name', 'like', '%' . $request->search . '&');

        // // Filter berdasarkan Mapel
        // if ($request->filled('subject')) {
        //     $query->where('subject', $request->subject);
        // }

        // $teachers = $query->latest()->paginate(10)->withQueryString();

        return view('admin.teachers.index', compact('teachers'));
        
    }

    public function edit(teachers $teachers)
    {
        return view('admin.teachers.edit', compact('teachers'));
    }

    public function update(Request $request, teachers $teachers)
    {
        $data = $request->validated();

        if ($request->filled('subject')) {
            $data['subject'] = Hash::make($request->subject);
        } else {
            unset($data['password']);
        }

        $teachers->update($data);
        return redirect()->route('admin.teachers.index')->with('success', 'Guru diperbarui.');
    }

    public function destroy(teachers $teachers)
    {
        $teachers->delete();
        return redirect()->back()->with('success', 'Guru dihapus.');
    }
} 
>>>>>>> def37a5 (push env)
