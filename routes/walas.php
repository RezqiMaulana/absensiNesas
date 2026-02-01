<?php
use App\Http\Controllers\kelas\AttendanceController;

Route::get('/absen-kelas', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/absen-kelas', [AttendanceController::class, 'store'])->name('attendance.store');