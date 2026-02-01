<?php
use App\Http\Controllers\Piket\DashboardController;
use App\Http\Controllers\Rekapcontroller;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('/rekap',Rekapcontroller::class)->only('index','store');