@extends('layouts.app')
@section('title', 'Tambah Siswa')
@section('content')
<div class="max-w-12xl mx-auto">
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('admin.students.index') }}" class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Tambah Siswa Baru</h1>
    </div>

    <form action="{{ route('admin.students.store') }}" method="POST" class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        @csrf
        <div class="p-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 dark:text-slate-300">NIS <span class="text-red-500">*</span></label>
                    <input type="text" name="nis" value="{{ old('nis') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-transparent dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" placeholder="Masukkan NIS..." required>
                    @error('nis')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 dark:text-slate-300">NISN <span class="text-red-500">*</span></label>
                    <input type="text" name="nisn" value="{{ old('nisn') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-transparent dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" placeholder="Masukkan NISN..." required>
                    @error('nisn')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-transparent dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" placeholder="Masukkan nama lengkap siswa..." required>
                @error('name')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Kelas <span class="text-red-500">*</span></label>
                    <select name="classroom_id" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none appearance-none transition-all" required>
                        <option value="">Pilih Kelas</option>
                        @foreach($classrooms as $class)
                        <option value="{{ $class->id }}" {{ old('classroom_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->name }} ({{ $class->building->name }})
                        </option>
                        @endforeach
                    </select>
                    @error('classroom_id')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 dark:text-slate-300">RFID Number <span class="text-slate-400">(Opsional)</span></label>
                    <input type="text" name="rfid_number" value="{{ old('rfid_number') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-transparent dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" placeholder="Masukkan nomor RFID...">
                    @error('rfid_number')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="p-6 bg-slate-50 dark:bg-slate-900/50 flex justify-end gap-3">
            <button type="reset" class="px-6 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-700 dark:hover:text-white transition-all">Reset</button>
            <button type="submit" class="px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-blue-200 dark:shadow-none transition-all">Simpan Siswa</button>
        </div>
    </form>
</div>
@endsection
