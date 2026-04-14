@extends('layouts.app')
@section('title', 'Import Guru')
@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('piket.teachers.index') }}" class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-lg transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Import Guru</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Import data guru dari file Excel.</p>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 p-8 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm">
        <div class="space-y-6">
            <div>
                <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-4">Template Excel</h3>
                <p class="text-sm text-slate-600 dark:text-slate-400 mb-4">
                    Unduh template Excel untuk memudahkan pengisian data guru. Pastikan kolom sesuai dengan format yang ditentukan.
                </p>
                <a href="{{ route('piket.teachers.export') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl transition-all shadow-lg">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Unduh Template
                </a>
            </div>

            <div class="border-t border-slate-200 dark:border-slate-700 pt-6">
                <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-4">Upload File Excel</h3>
                <form action="{{ route('piket.teachers.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <x-input-label for="file" value="Pilih File Excel" />
                        <input id="file" name="file" type="file" class="mt-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept=".xlsx,.xls,.csv" required />
                        <x-input-error :messages="$errors->get('file')" class="mt-2" />
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Format yang didukung: .xlsx, .xls, .csv. Maksimal 2MB.</p>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4">
                        <a href="{{ route('piket.teachers.index') }}" class="px-6 py-2.5 text-slate-600 dark:text-slate-300 hover:text-slate-800 dark:hover:text-white text-sm font-bold rounded-xl transition-all">
                            Batal
                        </a>
                        <x-primary-button>
                            Import Data
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
