@extends('layouts.app')
@section('title', 'Edit Siswa')
@section('content')
<div class="max-w-12xl mx-auto">
    <div class="mb-12 flex items-center gap-4">
        <a href="{{ route('admin.students.index') }}" class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-white transition-colors bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Edit Siswa</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Mengubah informasi siswa: <span class="font-mono text-blue-600 dark:text-blue-400">{{ $student->nis }}</span></p>
        </div>
    </div>

    <form action="{{ route('admin.students.update', $student->id) }}" method="POST" class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        @csrf
        @method('PUT')
        
        <div class="p-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 dark:text-slate-300">NIS <span class="text-red-500">*</span></label>
                    <input type="text" name="nis" value="{{ old('nis', $student->nis) }}" 
                        class="w-full px-4 py-3 rounded-xl border {{ $errors->has('nis') ? 'border-red-500' : 'border-slate-200 dark:border-slate-700' }} bg-transparent dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
                    @error('nis')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 dark:text-slate-300">NISN <span class="text-red-500">*</span></label>
                    <input type="text" name="nisn" value="{{ old('nisn', $student->nisn) }}" 
                        class="w-full px-4 py-3 rounded-xl border {{ $errors->has('nisn') ? 'border-red-500' : 'border-slate-200 dark:border-slate-700' }} bg-transparent dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
                    @error('nisn')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $student->name) }}" 
                    class="w-full px-4 py-3 rounded-xl border {{ $errors->has('name') ? 'border-red-500' : 'border-slate-200 dark:border-slate-700' }} bg-transparent dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
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
                        <option value="{{ $class->id }}" {{ $student->classroom_id == $class->id ? 'selected' : '' }}>
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
                    <input type="text" name="rfid_number" value="{{ old('rfid_number', $student->rfid_number) }}" 
                        class="w-full px-4 py-3 rounded-xl border {{ $errors->has('rfid_number') ? 'border-red-500' : 'border-slate-200 dark:border-slate-700' }} bg-transparent dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" placeholder="Masukkan nomor RFID...">
                    @error('rfid_number')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="p-6 bg-slate-50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-700 flex justify-between items-center gap-3">
            <span class="text-xs text-slate-400 italic hidden sm:block">Terakhir diperbarui: {{ $student->updated_at->diffForHumans() }}</span>
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
