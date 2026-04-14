<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\building;
use Illuminate\Support\Facades\Hash;

class BuildingController extends Controller
{
    public function index(Request $request)
    {
        $query = building::with('classrooms');

        // Pencarian berdasarkan Nama atau Area
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('area', 'like', '%' . $request->search . '%');
            });
        }

        $buildings = $query->latest()->paginate(10)->withQueryString();

        return view('admin.building.index', compact('buildings'));
    }

    public function create()
    {
        return view('admin.building.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'area' => 'required|string|max:255',
        ]);

        Building::create($request->only(['name', 'area']));

        return redirect()->route('admin.building.index')->with('success', 'Gedung berhasil ditambahkan.');
    }

    public function edit(Building $building)
    {
        return view('admin.building.edit', compact('building'));
    }

    public function update(Request $request, Building $building)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'area' => 'required|string|max:255',
        ]);

        $building->update($request->only(['name', 'area']));
        return redirect()->route('admin.building.index')->with('success', 'Gedung diperbarui.');
    }

    public function destroy(Building $building)
    {
        $building->delete();
        return redirect()->back()->with('success', 'Gedung dihapus.');
    }
}
