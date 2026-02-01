@extends('layouts.app')
@section('title', 'Kelola Users')
@section('content')
<div class="max-w-12xl mx-auto">
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('admin.users.index') }}" class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Tambah Pengguna Baru</h1>
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST" class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        @csrf
        <div class="p-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Nama Lengkap</label>
                    <input type="text" name="name" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-transparent dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" placeholder="Masukkan nama..." required>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Username</label>
                    <input type="text" name="username" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-transparent dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" placeholder="ID Unik..." required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Peran Pengguna</label>
                    <select name="role" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none appearance-none transition-all">
                        <option value="admin">Admin Gedung</option>
                        <option value="piket">Petugas Piket</option>
                        <option value="wali_kelas">Wali Kelas</option>
                        <option value="perwakilan_siswa">Perwakilan Siswa</option>
                    </select>
                </div>
                <div class="space-y-2" x-data="{ role: 'admin' }" x-init="$watch('role', value => console.log(value))">
                    <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Kelas (Opsional)</label>
                    <select name="classroom_id" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                        <option value="">Tidak Ada Kelas</option>
                        @foreach($classrooms as $class)
                        <option value="{{ $class->id }}">{{ $class->name }} ({{ $class->building->name }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-100 dark:border-slate-700">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-transparent dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-transparent dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
                </div>
            </div>
        </div>

        <div class="p-6 bg-slate-50 dark:bg-slate-900/50 flex justify-end gap-3">
            <button type="reset" class="px-6 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-700 dark:hover:text-white transition-all">Reset</button>
            <button type="submit" class="px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-blue-200 dark:shadow-none transition-all">Simpan User</button>
        </div>
    </form>
</div>
@endsection