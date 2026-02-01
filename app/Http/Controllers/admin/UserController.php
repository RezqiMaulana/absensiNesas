<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Classroom;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\user\StoreUserRequest;
use App\Http\Requests\Admin\user\UpdateUserRequest;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // $users = User::with('classroom')->latest()->paginate(10);

        $query = User::with('classroom.building');

        // Pencarian berdasarkan Nama atau Username
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('username', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan Role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Filter berdasarkan Kelas
        if ($request->filled('classroom_id')) {
            $query->where('classroom_id', $request->classroom_id);
        }

        $users = $query->latest()->paginate(10)->withQueryString();
        $classrooms = Classroom::all(); // Untuk isi dropdown filter
        
        return view('admin.users.index', compact('users','classrooms'));
    }

    public function create()
    {
        $classrooms = Classroom::all();
        return view('admin.users.create', compact('classrooms'));
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($request->password);
        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $classrooms = Classroom::all();
        return view('admin.users.edit', compact('user', 'classrooms'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        return redirect()->route('admin.users.index')->with('success', 'User diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User dihapus.');
    }

    public function importcreated()
    {
        return view('admin.users.import');
    }

    public function exportTemplate()
    {
        // Membuat array untuk header template
        $header = [
            ['nama', 'username', 'role', 'classroom_id', 'password'],
            ['Contoh Nama', 'user123', 'wali_kelas', '1', 'password123'],
        ];

        return Excel::download(new class($header) implements \Maatwebsite\Excel\Concerns\FromArray {
            protected $data;
            public function __construct($data) { $this->data = $data; }
            public function array(): array { return $this->data; }
        }, 'template_user.xlsx');
    }


    public function import(Request $request) 
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048'
        ]);

        try {
            Excel::import(new UsersImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data user berhasil diimpor!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['file' => 'Terjadi kesalahan saat impor: ' . $e->getMessage()]);
        }
    }
}
