@extends('layouts.app')
<<<<<<< HEAD
@section('title', 'Kelola Teachers')
=======
@section('title', 'Data Guru')
>>>>>>> def37a5 (push env)
@section('content')
<div class="space-y-6">
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8">
    <div>
<<<<<<< HEAD
        <h1 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Manajemen Guru</h1>
=======
        <h1 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Data Guru</h1>
>>>>>>> def37a5 (push env)
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
            Total terdapat <span class="font-bold text-blue-600 dark:text-blue-400">{{ $teachers->total() }}</span> guru terdaftar dalam sistem.
        </p>
    </div>

    <div class="flex flex-wrap items-center gap-3">
<<<<<<< HEAD
        <a href="{{ route('admin.teachers.import') }}"
=======
        <a href="{{ route('admin.teachers.import') }}" 
>>>>>>> def37a5 (push env)
           class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 text-sm font-bold rounded-xl transition-all shadow-sm">
            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
            </svg>
            Import Excel
        </a>

<<<<<<< HEAD
        <a href="{{ route('admin.teachers.create') }}"
=======
        <a href="{{ route('admin.users.create') }}" 
>>>>>>> def37a5 (push env)
           class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-blue-200 dark:shadow-none">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
<<<<<<< HEAD
            Tambah Guru Baru
=======
            Tambah User Baru
>>>>>>> def37a5 (push env)
        </a>
    </div>
</div>
    <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm mb-6">
<<<<<<< HEAD
    <form action="{{ route('admin.teachers.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="md:col-span-2 relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </span>
            <input type="text" name="search" value="{{ request('search') }}"
                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                placeholder="Cari nama atau NIP...">
        </div>

        <div class="relative">
            <select name="subject" onchange="this.form.submit()"
                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none appearance-none cursor-pointer transition-all">
                <option value="">Semua Mata Pelajaran</option>
                @foreach($subjects as $subj)
                    <option value="{{ $subj }}" {{ request('subject') == $subj ? 'selected' : '' }}>
                        {{ $subj }}
=======
    <form action="{{ route('admin.teachers.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        
        <div class="md:col-span-3 relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </span>
            <input type="text" name="search" value="{{ request('search') }}" 
                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" 
                placeholder="Cari nama guru atau mata pelajaran.....">
        </div>

        <!-- <div class="relative">
            <select name="role" onchange="this.form.submit()" 
                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none appearance-none cursor-pointer transition-all">
                <option value="">Semua Role</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="piket" {{ request('role') == 'piket' ? 'selected' : '' }}>Piket</option>
                <option value="wali_kelas" {{ request('role') == 'wali_kelas' ? 'selected' : '' }}>Wali Kelas</option>
                <option value="perwakilan_siswa" {{ request('role') == 'perwakilan_siswa' ? 'selected' : '' }}>Siswa</option>
            </select>
        </div> -->

        <div class="relative">
            <select name="subject" onchange="this.form.submit()" 
                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none appearance-none cursor-pointer transition-all">
                <option value="">Mata Pelajaran</option>
                @foreach($teachers as $guru)
                    <option value="{{ $guru->id }}" {{ request('subject') == $guru->id ? 'selected' : '' }}>
                        {{ $guru->subject }}
>>>>>>> def37a5 (push env)
                    </option>
                @endforeach
            </select>
        </div>

        @if(request('search') || request('subject'))
<<<<<<< HEAD
        <div class="md:col-span-3 flex justify-end">
=======
        <div class="md:col-span-4 flex justify-end">
>>>>>>> def37a5 (push env)
            <a href="{{ route('admin.teachers.index') }}" class="text-xs font-bold text-red-500 hover:text-red-600 flex items-center gap-1 transition-colors uppercase tracking-wider">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                Bersihkan Filter
            </a>
        </div>
        @endif
    </form>
</div>

    <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-700">
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Nama Guru</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">NIP</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Mata Pelajaran</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
<<<<<<< HEAD
                    @foreach($teachers as $teacher)
=======
                    @foreach($teachers as $guru)
>>>>>>> def37a5 (push env)
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-500 font-bold">
<<<<<<< HEAD
                                    {{ substr($teacher->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800 dark:text-white">{{ $teacher->name }}</div>
=======
                                    {{ substr($guru->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800 dark:text-white">{{ $guru->name }}</div>
                                    <div class="text-xs text-slate-500 italic">@ {{ $guru->subject }}</div>
>>>>>>> def37a5 (push env)
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-slate-600 dark:text-slate-400">
<<<<<<< HEAD
                                {{ $teacher->nip ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                                {{ $teacher->subject }}
=======
                                {{ $guru->nip }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $subjectClasses = [
                                    'Matematika' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
                                    'Bahasa Inggris' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
                                    'Bahasa Indonesia' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
                                ];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest {{ $subjectClasses[$guru->subject] ?? 'bg-slate-100 text-slate-600' }}">
                                {{ str_replace('_', ' ', $guru->subject) }}
>>>>>>> def37a5 (push env)
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center items-center gap-2">
<<<<<<< HEAD
                                <a href="{{ route('admin.teachers.edit', $teacher) }}" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus guru ini?')">
                                    @csrf @method('DELETE')
=======
                                <a href="{{ route('admin.teacher.edit', $guru) }}" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('admin.teacher.destroy', $guru) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                    @csrf 
                                    @method('DELETE')
>>>>>>> def37a5 (push env)
                                    <button class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($teachers->hasPages())
        <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700 bg-slate-50/30 dark:bg-slate-900/30">
            {{ $teachers->links() }}
        </div>
        @endif
    </div>
</div>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> def37a5 (push env)
