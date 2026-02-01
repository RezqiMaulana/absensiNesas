@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Rekap & Riwayat Kehadiran</h1>
            <p class="text-sm text-slate-500">Filter dan unduh laporan kehadiran siswa dalam format Excel.</p>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm">
        <form action="{{ route('piket.rekap.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase mb-2">Mulai Tanggal</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-transparent dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase mb-2">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-transparent dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase mb-2">Gedung/Area</label>
                <select name="building_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Area</option>
                    @foreach($buildings as $b)
                        <option value="{{ $b->id }}" {{ request('building_id') == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-slate-800 dark:bg-slate-700 text-white px-4 py-2.5 rounded-xl font-bold text-sm hover:opacity-90 transition-all">Filter</button>
                <a href="{{ route('piket.rekap.store', request()->all()) }}" class="flex-1 bg-emerald-600 text-white px-4 py-2.5 rounded-xl font-bold text-sm hover:bg-emerald-700 transition-all text-center">
                    Cetak Excel
                </a>
            </div>
        </form>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200 dark:border-slate-700 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 dark:bg-slate-900/50">
                    <tr class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase">
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Siswa</th>
                        <th class="px-6 py-4">Gedung</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                    @foreach($history as $item)
                    <tr class="text-sm hover:bg-slate-50 dark:hover:bg-slate-700/30">
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-400">{{ $item->date->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 font-bold text-slate-800 dark:text-white">{{ $item->student->name }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $item->student->classroom->building->name }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $item->status == 'hadir' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $history->links() }}
        </div>
    </div>
</div>
@endsection