@extends('layouts.app')
@section('title', 'Input Absensi - ' . ($user->classroom->name ?? 'Kelas'))
@section('content')
<div class="space-y-6">
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Input Absensi Kelas</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                Kelas <span class="font-bold text-blue-600 dark:text-blue-400">{{ $user->classroom->name ?? '-' }}</span> - 
                Total <span class="font-bold text-emerald-600 dark:text-emerald-400">{{ $students->count() }}</span> siswa terdaftar.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <span class="px-4 py-2 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-xl font-bold text-sm">
                {{ date('d M Y') }}
            </span>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm">
        @if($students->isEmpty())
            <div class="text-center py-12">
                <div class="w-16 h-16 mx-auto mb-4 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <p class="text-slate-500 dark:text-slate-400">Tidak ada siswa di kelas ini.</p>
            </div>
        @else
            <form action="{{ route('attendance.store') }}" method="POST">
                @csrf
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-700">
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">No</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Nama Siswa</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 text-center">Hadir</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 text-center">Sakit</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 text-center">Izin</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 text-center">Alpa</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                            @foreach($students as $index => $student)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="text-sm font-mono text-slate-600 dark:text-slate-400">{{ $index + 1 }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 font-bold">
                                            {{ substr($student->name, 0, 1) }}
                                        </div>
                                        <div class="font-bold text-slate-800 dark:text-white">{{ $student->name }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <label class="inline-flex">
                                        <input type="radio" name="siswa[{{ $student->id }}]" value="hadir" 
                                            class="hidden peer" 
                                            {{ isset($attendances[$student->id]) && $attendances[$student->id] == 'hadir' ? 'checked' : '' }}>
                                        <span class="w-10 h-10 rounded-xl border border-slate-200 dark:border-slate-600 peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600 cursor-pointer transition-all text-sm font-bold hover:border-blue-400 flex items-center justify-center">H</span>
                                    </label>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <label class="inline-flex">
                                        <input type="radio" name="siswa[{{ $student->id }}]" value="sakit" 
                                            class="hidden peer"
                                            {{ isset($attendances[$student->id]) && $attendances[$student->id] == 'sakit' ? 'checked' : '' }}>
                                        <span class="w-10 h-10 rounded-xl border border-slate-200 dark:border-slate-600 peer-checked:bg-orange-500 peer-checked:text-white peer-checked:border-orange-500 cursor-pointer transition-all text-sm font-bold hover:border-orange-400 flex items-center justify-center">S</span>
                                    </label>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <label class="inline-flex">
                                        <input type="radio" name="siswa[{{ $student->id }}]" value="izin" 
                                            class="hidden peer"
                                            {{ isset($attendances[$student->id]) && $attendances[$student->id] == 'izin' ? 'checked' : '' }}>
                                        <span class="w-10 h-10 rounded-xl border border-slate-200 dark:border-slate-600 peer-checked:bg-yellow-500 peer-checked:text-white peer-checked:border-yellow-500 cursor-pointer transition-all text-sm font-bold hover:border-yellow-400 flex items-center justify-center">I</span>
                                    </label>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <label class="inline-flex">
                                        <input type="radio" name="siswa[{{ $student->id }}]" value="alpa" 
                                            class="hidden peer"
                                            {{ isset($attendances[$student->id]) && $attendances[$student->id] == 'alpa' ? 'checked' : '' }}>
                                        <span class="w-10 h-10 rounded-xl border border-slate-200 dark:border-slate-600 peer-checked:bg-red-500 peer-checked:text-white peer-checked:border-red-500 cursor-pointer transition-all text-sm font-bold hover:border-red-400 flex items-center justify-center">A</span>
                                    </label>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-blue-200 dark:shadow-none">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Absensi Hari Ini
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection
