@extends('layouts.app')
@section('title', 'Input Absensi')
@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
        <div class="flex justify-between items-center mb-8">
            <h3 class="font-bold text-xl text-slate-800">Absensi Kelas: XII RPL 1</h3>
            <span class="px-4 py-2 bg-slate-100 rounded-xl text-slate-600 font-bold text-sm">{{ date('d M Y') }}</span>
        </div>

        <form action="#" method="POST">
            @csrf
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl">
                    <span class="font-semibold text-slate-700">Ahmad Dhani</span>
                    <div class="flex gap-2">
                        <label><input type="radio" name="siswa[1]" value="hadir" class="hidden peer"><span class="px-4 py-2 rounded-xl border border-slate-200 peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600 cursor-pointer transition-all text-sm font-bold">H</span></label>
                        <label><input type="radio" name="siswa[1]" value="izin" class="hidden peer"><span class="px-4 py-2 rounded-xl border border-slate-200 peer-checked:bg-yellow-500 peer-checked:text-white peer-checked:border-yellow-500 cursor-pointer transition-all text-sm font-bold">I</span></label>
                        <label><input type="radio" name="siswa[1]" value="alpa" class="hidden peer"><span class="px-4 py-2 rounded-xl border border-slate-200 peer-checked:bg-red-500 peer-checked:text-white peer-checked:border-red-500 cursor-pointer transition-all text-sm font-bold">A</span></label>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full mt-8 bg-slate-800 text-white font-bold py-4 rounded-2xl shadow-lg hover:bg-slate-900 transition-all">Simpan Absensi Hari Ini</button>
        </form>
    </div>
</div>
@endsection