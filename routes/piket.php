<?php
use App\Http\Controllers\Piket\DashboardController;
use App\Http\Controllers\piket\exitpermissionscontroller;
use App\Http\Controllers\Rekapcontroller;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('exit_permissions', exitpermissionscontroller::class)->except(['show']);
Route::post('exit_permissions/import', [exitpermissionscontroller::class, 'import'])->name('exit_permissions.import');
Route::get('exit_permissions/import', [exitpermissionscontroller::class, 'importcreated'])->name('exit_permissions.import');
Route::resource('/rekap',Rekapcontroller::class)->only('index','store');
