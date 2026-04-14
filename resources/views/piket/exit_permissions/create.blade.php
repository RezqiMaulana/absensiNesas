@extends('layouts.app')
@section('title', 'Tambah Izin Keluar')
@section('content')
<div class="space-y-6 max-w-4xl">
    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('piket.exit_permissions.index') }}" class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Tambah Izin Keluar</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Isi form di bawah untuk menambahkan izin keluar siswa.</p>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm p-8">
        <form action="{{ route('piket.exit_permissions.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <x-input-label for="student_id" value="Siswa" />
                    <select name="student_id" id="student_id" class="mt-1 block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all py-2.5 px-4" required>
                        <option value="">Pilih Siswa</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="teacher_id" value="Guru Pengajar" />
                    <select name="teacher_id" id="teacher_id" class="mt-1 block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all py-2.5 px-4" required>
                        <option value="">Pilih Guru</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }} - {{ $teacher->subject ?? '-' }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('teacher_id')" class="mt-2" />
                </div>
            </div>
            <div>
                <x-input-label for="piket_id" value="Piket" />
                <select name="piket_id" id="piket_id" class="mt-1 block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all py-2.5 px-4" required>
                    <option value="">Pilih Piket</option>
                    @foreach($pikets as $piket)
                        <option value="{{ $piket->id }}">{{ $piket->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('piket_id')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="reason" value="Alasan Keluar" />
                <textarea name="reason" id="reason" rows="4" class="mt-1 block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all py-2.5 px-4 resize-vertical" placeholder="Masukkan alasan keluar siswa (contoh: sakit, urusan keluarga, dll)" required>{{ old('reason') }}</textarea>
                <x-input-error :messages="$errors->get('reason')" class="mt-2" />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <x-input-label for="leave_at" value="Waktu Keluar" />
                    <input type="time" name="leave_at" id="leave_at" value="{{ old('leave_at') }}" class="mt-1 block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all py-2.5 px-4" required>
                    <x-input-error :messages="$errors->get('leave_at')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="return_at" value="Waktu Kembali (Opsional)" />
                    <input type="time" name="return_at" id="return_at" value="{{ old('return_at') }}" class="mt-1 block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all py-2.5 px-4">
                    <x-input-error :messages="$errors->get('return_at')" class="mt-2" />
                </div>
            </div>
            <div>
                <x-input-label for="status" value="Status" />
                <select name="status" id="status" class="mt-1 block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all py-2.5 px-4" required>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                <x-input-error :messages="$errors->get('status')" class="mt-2" />
            </div>
            <div class="flex flex-col sm:flex-row gap-3 pt-4">
                <a href="{{ route('piket.exit_permissions.index') }}" class="flex-1 sm:flex-none px-6 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-800 dark:text-slate-200 font-bold rounded-xl transition-all text-center">
                    Batal
                </a>
                <x-primary-button type="submit" class="flex-1 sm:flex-none">Simpan Izin Keluar</x-primary-button>
            </div>
        </form>
    </div>
</div>
@endsection

