@extends('layouts.app')
@section('title', 'Admin')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Total Gedung</p>
        <h3 class="text-3xl font-bold text-slate-800">2 Area</h3>
    </div>
    </div>

<div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
    <h3 class="font-bold text-slate-800 mb-6">Manajemen Cepat</h3>
    <div class="grid grid-cols-2 gap-4">
        <button class="p-4 border-2 border-dashed border-slate-200 rounded-2xl hover:border-blue-500 hover:text-blue-500 transition-all text-slate-500 font-semibold">+ Tambah User</button>
        <button class="p-4 border-2 border-dashed border-slate-200 rounded-2xl hover:border-blue-500 hover:text-blue-500 transition-all text-slate-500 font-semibold">+ Tambah Kelas</button>
    </div>
</div>
@endsection