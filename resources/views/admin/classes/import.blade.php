@extends('layouts.app')
@section('title', 'Import Kelas')
@section('content')
<div class="max-w-2xl space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight mb-2">Import Data Kelas</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">
            Upload file Excel dengan format template di bawah. Kolom: <code>name</code>, <code>building_id</code>.
        </p>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200 dark:border-slate-700 p-8 shadow-sm">
        <form action="{{ route('admin.classes.import') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <x-input-label for="file" value="Pilih File Excel" />
                <input type="file" id="file" name="file" accept=".xlsx,.xls,.csv" required 
                       class="mt-1 block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all file:mr-4 file:py-2.5 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-700 dark:file:text-slate-300">
                <x-input-error :messages="$errors->get('file')" class="mt-2" />
            </div>

            <div class="flex items-center gap-3">
                <x-primary-button type="submit">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                    </svg>
                    Import Data
                </x-primary-button>
                <a href="{{ route('admin.classes.export') }}" class="px-6 py-2.5 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 text-sm font-bold rounded-xl transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10l-5.5 5.5m0 0L7 19l5.5-5.5M12 10l5.5 5.5m-5.5 5.5L17 19"></path>
                    </svg>
                    Download Template
                </a>
                <a href="{{ route('admin.classes.index') }}" class="px-6 py-2.5 text-slate-600 dark:text-slate-300 hover:text-slate-800 dark:hover:text-slate-200 text-sm font-bold transition-colors">
                    Kembali
                </a>
            </div>
        </form>

        @if (session('success'))
            <div class="mt-6 p-4 rounded-2xl bg-green-50 border border-green-200 dark:bg-green-900/20 dark:border-green-800">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 ml-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-sm font-medium text-green-800 dark:text-green-200">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mt-6 p-4 rounded-2xl bg-red-50 border border-red-200 dark:bg-red-900/20 dark:border-red-800">
                <p class="text-sm font-medium text-red-800 dark:text-red-200">
                    {{ $errors->first() }}
                </p>
            </div>
        @endif
    </div>
</div>
@endsection

