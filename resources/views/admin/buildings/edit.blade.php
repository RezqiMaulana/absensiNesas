@extends('layouts.app')
@section('title', 'Edit Gedung')
@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="bg-white dark:bg-slate-800 p-8 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm">
        <div class="flex items-center gap-3 mb-6">
            <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Edit Gedung</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400">Perbarui informasi gedung.</p>
            </div>
        </div>

        <form action="{{ route('admin.buildings.update', $building) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nama Gedung</label>
                <input type="text" id="name" name="name" value="{{ old('name', $building->name) }}"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all @error('name') border-red-500 @enderror"
                    placeholder="Masukkan nama gedung...">
                @error('name')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="area" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Area</label>
                <select id="area" name="area"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all @error('area') border-red-500 @enderror">
                    <option value="" disabled>Pilih area...</option>
                    <option value="Kampus Depan" {{ old('area', $building->area) == 'Kampus Depan' ? 'selected' : '' }}>Kampus Depan</option>
                    <option value="Kampus Belakang" {{ old('area', $building->area) == 'Kampus Belakang' ? 'selected' : '' }}>Kampus Belakang</option>
                </select>
                @error('area')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4 pt-4">
                <a href="{{ route('admin.buildings.index') }}"
                   class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600 text-sm font-bold rounded-xl transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Batal
                </a>
                <button type="submit"
                        class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-blue-200 dark:shadow-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Gedung
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
