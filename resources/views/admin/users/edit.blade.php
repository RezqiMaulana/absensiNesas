@extends('layouts.app')
@section('title', 'Kelola Users')
@section('content')
<div class="max-w-12xl mx-auto">
    <div class="mb-12 flex items-center gap-4">
        <a href="{{ route('admin.users.index') }}" class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-white transition-colors bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Edit Pengguna</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Mengubah informasi akun: <span class="font-mono text-blue-600 dark:text-blue-400">{{ $user->username }}</span></p>
        </div>
    </div>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        @csrf
        @method('PUT')
        
        <div class="p-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                        class="w-full px-4 py-3 rounded-xl border {{ $errors->has('name') ? 'border-red-500' : 'border-slate-200 dark:border-slate-700' }} bg-transparent dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Username</label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}" 
                        class="w-full px-4 py-3 rounded-xl border {{ $errors->has('username') ? 'border-red-500' : 'border-slate-200 dark:border-slate-700' }} bg-transparent dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Peran Pengguna</label>
                    <select name="role" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin Gedung</option>
                        <option value="piket" {{ $user->role == 'piket' ? 'selected' : '' }}>Petugas Piket</option>
                        <option value="wali_kelas" {{ $user->role == 'wali_kelas' ? 'selected' : '' }}>Wali Kelas</option>
                        <option value="perwakilan_siswa" {{ $user->role == 'perwakilan_siswa' ? 'selected' : '' }}>Perwakilan Siswa</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Penempatan Kelas</label>
                    <select name="classroom_id" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                        <option value="">Tidak Ada Kelas (Akses Global)</option>
                        @foreach($classrooms as $class)
                        <option value="{{ $class->id }}" {{ $user->classroom_id == $class->id ? 'selected' : '' }}>
                            {{ $class->name }} ({{ $class->building->name }})
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 dark:border-slate-700">
                <div class="mb-4 bg-amber-50 dark:bg-amber-900/20 p-4 rounded-2xl border border-amber-100 dark:border-amber-800/50">
                    <p class="text-xs text-amber-700 dark:text-amber-400 font-medium flex gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Kosongkan password jika tidak ingin mengubahnya.
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Password Baru</label>
                        <input type="password" name="password" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-transparent dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-transparent dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6 bg-slate-50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-700 flex justify-between items-center gap-3">
            <span class="text-xs text-slate-400 italic hidden sm:block">Terakhir diperbarui: {{ $user->updated_at->diffForHumans() }}</span>
            <div class="flex gap-3 w-full sm:w-auto">
                <button type="reset" class="flex-1 sm:flex-none px-6 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-700 dark:hover:text-white transition-all">
                    Batalkan
                </button>
                <button type="submit" class="flex-1 sm:flex-none px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-blue-200 dark:shadow-none transition-all">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection