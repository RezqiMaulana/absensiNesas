@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Monitoring Kehadiran</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Laporan real-time per area gedung</p>
        </div>
        <div class="inline-flex items-center gap-3 px-4 py-2 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-2xl border border-blue-100 dark:border-blue-800">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span class="font-bold text-sm">{{ \Carbon\Carbon::parse($today)->translatedFormat('l, d F Y') }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($areas as $area)
        <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                <svg class="w-20 h-20 text-slate-900 dark:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <div class="relative z-10">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">{{ $area->name }}</p>
                <h3 class="text-3xl font-black text-slate-800 dark:text-white">{{ $area->present_count }} <span class="text-sm font-medium text-slate-400">/ Siswa Hadir</span></h3>
                <div class="mt-4 flex items-center gap-2">
                    <div class="flex-1 h-2 bg-slate-100 dark:bg-slate-700 rounded-full">
                        <div class="h-full bg-blue-600" style="width: {{ $area->percentage }}%"></div>
                    </div>
                    <span class="text-xs font-bold">{{ $area->percentage }}%</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm">
        <form action="{{ route('piket.dashboard') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1 relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama siswa..." 
                       class="w-full pl-10 pr-4 py-2 bg-slate-50 dark:bg-slate-900 border-none rounded-xl dark:text-white focus:ring-2 focus:ring-blue-500 transition-all">
                <svg class="w-5 h-5 absolute left-3 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <select name="building_id" onchange="this.form.submit()" 
                    class="md:w-64 px-4 py-2 bg-slate-50 dark:bg-slate-900 border-none rounded-xl dark:text-white focus:ring-2 focus:ring-blue-500 transition-all">
                <option value="">Semua Area Gedung</option>
                @foreach($areas as $area)
                <option value="{{ $area->id }}" {{ request('building_id') == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 dark:bg-slate-900/50">
                <tr class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                    <th class="px-6 py-4">Waktu</th>
                    <th class="px-6 py-4">Siswa</th>
                    <th class="px-6 py-4">Kelas / Area</th>
                    <th class="px-6 py-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                @forelse($attendances as $attendance)
                <tr class="text-sm hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                    <td class="px-6 py-4 text-slate-400 font-mono">{{ $attendance->created_at->format('H:i') }}</td>
                    <td class="px-6 py-4 font-bold text-slate-700 dark:text-white">{{ $attendance->student->name }}</td>
                    <td class="px-6 py-4">
                        <div class="text-slate-600 dark:text-slate-300">{{ $attendance->student->classroom->name }}</div>
                        <div class="text-[10px] text-slate-400 font-bold uppercase">{{ $attendance->student->classroom->building->name }}</div>
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $colors = [
                                'hadir' => 'bg-emerald-100 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400',
                                'alpa' => 'bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400',
                                'izin' => 'bg-amber-100 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400',
                            ];
                        @endphp
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $colors[$attendance->status] ?? 'bg-slate-100' }}">
                            {{ $attendance->status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-slate-400 italic">Belum ada data absensi hari ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection