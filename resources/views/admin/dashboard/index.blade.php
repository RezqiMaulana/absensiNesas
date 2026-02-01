@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="space-y-8">
    <div>
        <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Dashboard Admin</h1>
        <p class="text-sm text-slate-500">Selamat datang kembali, {{ auth()->user()->name }}. Berikut ringkasan sistem hari ini.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm transition-transform hover:scale-[1.02]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Pengguna</p>
                    <h3 class="text-2xl font-black text-slate-800 dark:text-white mt-1">{{ $stats['total_users'] }}</h3>
                </div>
                <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm transition-transform hover:scale-[1.02]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Siswa</p>
                    <h3 class="text-2xl font-black text-slate-800 dark:text-white mt-1">{{ $stats['total_students'] }}</h3>
                </div>
                <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/30 rounded-2xl flex items-center justify-center text-emerald-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm transition-transform hover:scale-[1.02]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Hadir Hari Ini</p>
                    <h3 class="text-2xl font-black text-slate-800 dark:text-white mt-1">{{ $stats['present_today'] }}</h3>
                </div>
                <div class="w-12 h-12 bg-amber-50 dark:bg-amber-900/30 rounded-2xl flex items-center justify-center text-amber-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 00-2 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm transition-transform hover:scale-[1.02]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Gedung</p>
                    <h3 class="text-2xl font-black text-slate-800 dark:text-white mt-1">{{ $stats['total_buildings'] }}</h3>
                </div>
                <div class="w-12 h-12 bg-purple-50 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-1 bg-white dark:bg-slate-800 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm p-6">
            <h3 class="font-bold text-slate-800 dark:text-white mb-6">Log Kehadiran Terkini</h3>
            <div class="space-y-6">
                @foreach($recentActivities as $activity)
                <div class="flex items-center gap-4">
                    <div class="w-2 h-10 rounded-full {{ $activity->status == 'hadir' ? 'bg-emerald-500' : 'bg-red-500' }}"></div>
                    <div class="flex-1">
                        <p class="text-sm font-bold text-slate-700 dark:text-slate-200">{{ $activity->student->name }}</p>
                        <p class="text-xs text-slate-400">{{ $activity->student->classroom->name }} • {{ $activity->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm p-6">
            <h3 class="font-bold text-slate-800 dark:text-white mb-6">Tren Kehadiran Mingguan</h3>
            <div class="h-64 flex items-end justify-between gap-2 px-4">
                @foreach($chartData as $data)
                    <div class="flex-1 bg-blue-600/20 dark:bg-blue-400/10 rounded-t-lg relative group transition-all hover:bg-blue-600" 
                         style="height: {{ ($data->aggregate / max($stats['total_students'], 1)) * 100 }}%">
                        <span class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                            {{ $data->aggregate }}
                        </span>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-between mt-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest px-2">
                @foreach($chartData as $data)
                    <span>{{ date('d M', strtotime($data->date)) }}</span>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection