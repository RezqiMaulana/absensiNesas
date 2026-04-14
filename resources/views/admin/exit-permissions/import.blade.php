@extends('layouts.app')
@section('title', 'Import Izin Keluar')
@section('content')
<div class="space-y-6 max-w-2xl">
    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('admin.exit-permissions.index') }}" class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Import Data Izin Keluar</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Upload file Excel untuk import data izin keluar.</p>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm p-8">
        <div class="space-y-4">
            <div>
                <a href="{{ route('admin.exit-permissions.export') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition-all shadow-lg">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10l-5.5 5.5m0 0L7.5 19.5m2.5-4.5L17 9.5"></path>
                    </svg>
                    Download Template
                </a>
            </div>
            <form action="{{ route('admin.exit-permissions.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <x-input-label for="file" value="Pilih File Excel" />
                    <input type="file" name="file" id="file" accept=".xlsx,.xls,.csv" class="mt-1 block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all py-2.5 px-4 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-700 dark:file:text-slate-200" required>
                    <x-input-error :messages="$errors->get('file')" class="mt-2" />
                    <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Format: XLSX, XLS, CSV. Max 2MB. Gunakan template di atas.</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.exit-permissions.index') }}" class="flex-1 sm:flex-none px-6 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-800 dark:text-slate-200 font-bold rounded-xl transition-all text-center">
                        Batal
                    </a>
                    <x-primary-button type="submit" class="flex-1 sm:flex-none">Import Data</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

