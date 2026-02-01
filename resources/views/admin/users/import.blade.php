@extends('layouts.app')

@section('content')
<div class="max-w-12xl mx-auto">
    <div class="mb-8 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.users.index') }}" class="p-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-400 hover:text-blue-600 transition-all shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Impor Data Pengguna</h1>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-1 space-y-6">
            <div class="bg-blue-600 rounded-3xl p-6 text-white shadow-xl shadow-blue-200 dark:shadow-none">
                <h3 class="font-bold mb-2 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Instruksi
                </h3>
                <ul class="text-xs space-y-3 opacity-90 font-medium">
                    <li>1. Unduh template Excel yang sudah disediakan.</li>
                    <li>2. Isi data sesuai kolom (Nama, Username, Role, ID Kelas, Password).</li>
                    <li>3. Role yang tersedia: <br><b class="underline">admin, piket, wali_kelas, perwakilan_siswa</b>.</li>
                    <li>4. Pastikan username tidak duplikat.</li>
                </ul>
                <a href="{{ route('admin.users.export') }}" class="mt-6 inline-flex items-center justify-center w-full py-3 bg-white text-blue-600 rounded-xl font-bold text-sm hover:bg-blue-50 transition-colors">
                    📥 Unduh Template
                </a>
                <a href="{{ route('admin.users.export') }}">tster</a>
            </div>
        </div>

        <div class="md:col-span-2">
            <form action="{{ route('admin.users.import') }}" method="POST" enctype="multipart/form-data" 
                  x-data="{ isUploading: false }" @submit="isUploading = true"
                  class="bg-white dark:bg-slate-800 rounded-3xl border-2 border-dashed border-slate-200 dark:border-slate-700 p-8 text-center transition-all hover:border-blue-400">
                @csrf
                
                <div x-show="!isUploading">
                    <div class="w-20 h-20 bg-blue-50 dark:bg-blue-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                    </div>
                    
                    <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-2">Pilih File Excel</h2>
                    <p class="text-sm text-slate-400 mb-8">Format yang didukung: .xlsx, .xls, atau .csv (Maks 2MB)</p>

                    <label class="cursor-pointer">
                        <span class="px-8 py-3 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded-xl font-bold text-sm hover:bg-slate-200 transition-all">Pilih File</span>
                        <input type="file" name="file" class="hidden" required>
                    </label>

                    <button type="submit" class="block w-full mt-12 py-4 bg-blue-600 text-white rounded-2xl font-bold shadow-lg shadow-blue-200 dark:shadow-none hover:bg-blue-700 transition-all">
                        🚀 Mulai Impor Data
                    </button>
                </div>

                <div x-show="isUploading" x-cloak class="py-12">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
                    <p class="text-slate-600 dark:text-slate-400 font-bold">Sedang memproses data, mohon tunggu...</p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection