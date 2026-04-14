@extends('layouts.app')
@section('title', 'Edit Kelas - ' . $classroom->name)

@section('content')
<div class="space-y-6 max-w-2xl">
    <div>
        <h1 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight mb-2">Edit Kelas {{ $classroom->name }}</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400">Update informasi kelas di bawah ini.</p>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200 dark:border-slate-700 p-8 shadow-sm">
        <form action="{{ route('admin.classes.update', $classroom) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                <div>
                    <x-input-label for="name" value="Nama Kelas" />
                    <x-text-input 
                        id="name" 
                        name="name" 
                        type="text" 
                        class="mt-1 block w-full" 
                        value="{{ old('name', $classroom->name) }}" 
                        required 
                        autofocus
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="building_id" value="Gedung" />
                    <select id="building_id" name="building_id" required class="mt-1 block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                        <option value="">Pilih Gedung</option>
                        @foreach($buildings as $id => $name)
                            <option value="{{ $id }}" {{ old('building_id', $classroom->building_id) == $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('building_id')" class="mt-2" />
                </div>

                <div class="flex items-center gap-3 pt-4">
                    <x-primary-button>
                        {{ __('Update Kelas') }}
                    </x-primary-button>
                    <a href="{{ route('admin.classes.index') }}" class="px-6 py-2.5 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 text-sm font-bold rounded-xl transition-all">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

