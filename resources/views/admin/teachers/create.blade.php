@extends('layouts.app')
@section('title', 'Tambah Guru')
@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.teachers.index') }}" class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-lg transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Tambah Guru Baru</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Tambahkan guru baru ke dalam sistem.</p>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 p-8 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm">
        <form action="{{ route('admin.teachers.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <x-input-label for="name" value="Nama Guru" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="nip" value="NIP (Nomor Induk Pegawai)" />
                <x-text-input id="nip" name="nip" type="text" class="mt-1 block w-full" :value="old('nip')" autocomplete="nip" />
                <x-input-error :messages="$errors->get('nip')" class="mt-2" />
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Opsional, biarkan kosong jika tidak ada.</p>
            </div>

            <div>
                <x-input-label for="subject" value="Mata Pelajaran" />
                <x-text-input id="subject" name="subject" type="text" class="mt-1 block w-full" :value="old('subject')" required autocomplete="subject" />
                <x-input-error :messages="$errors->get('subject')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-200 dark:border-slate-700">
                <a href="{{ route('admin.teachers.index') }}" class="px-6 py-2.5 text-slate-600 dark:text-slate-300 hover:text-slate-800 dark:hover:text-white text-sm font-bold rounded-xl transition-all">
                    Batal
                </a>
                <x-primary-button>
                    Tambah Guru
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
@endsection
