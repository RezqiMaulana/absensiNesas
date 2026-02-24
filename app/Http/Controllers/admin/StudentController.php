<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Classroom;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Student::with('classroom');

        // Pencarian berdasarkan Nama, NIS, atau NISN
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('nis', 'like', '%' . $request->search . '%')
                ->orWhere('nisn', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan Kelas
        if ($request->filled('classroom_id')) {
            $query->where('classroom_id', $request->classroom_id);
        }

        $students = $query->latest()->paginate(10)->withQueryString();
        $classrooms = Classroom::all();
        
        return view('admin.students.index', compact('students', 'classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classrooms = Classroom::all();
        return view('admin.students.create', compact('classrooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|string|max:255|unique:students,nis',
            'nisn' => 'required|string|max:255|unique:students,nisn',
            'rfid_number' => 'nullable|string|max:255|unique:students,rfid_number',
            'name' => 'required|string|max:255',
            'classroom_id' => 'required|exists:classrooms,id',
        ]);

        Student::create($validated);

        return redirect()->route('admin.students.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $classrooms = Classroom::all();
        return view('admin.students.edit', compact('student', 'classrooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'nis' => 'required|string|max:255|unique:students,nis,' . $student->id,
            'nisn' => 'required|string|max:255|unique:students,nisn,' . $student->id,
            'rfid_number' => 'nullable|string|max:255|unique:students,rfid_number,' . $student->id,
            'name' => 'required|string|max:255',
            'classroom_id' => 'required|exists:classrooms,id',
        ]);

        $student->update($validated);

        return redirect()->route('admin.students.index')->with('success', 'Siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->back()->with('success', 'Siswa berhasil dihapus.');
    }

    /**
     * Show the form for importing students.
     */
    public function importcreated()
    {
        return view('admin.students.import');
    }

    /**
     * Export template for student import.
     */
    public function exportTemplate()
    {
        // Membuat array untuk header template
        $header = [
            ['nis', 'nisn', 'rfid_number', 'name', 'classroom_id'],
            ['12345', '0123456789', 'RFID001', 'Contoh Nama', '1'],
        ];

        return Excel::download(new class($header) implements \Maatwebsite\Excel\Concerns\FromArray {
            protected $data;
            public function __construct($data) { $this->data = $data; }
            public function array(): array { return $this->data; }
        }, 'template_siswa.xlsx');
    }

    /**
     * Import students from Excel file.
     */
    public function import(Request $request) 
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048'
        ]);

        try {
            Excel::import(new StudentsImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data siswa berhasil diimpor!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['file' => 'Terjadi kesalahan saat impor: ' . $e->getMessage()]);
        }
    }
}
