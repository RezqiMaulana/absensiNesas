<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\TeachersController;
use App\Http\Controllers\Admin\UserController;
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('users',UserController::class)->except("show");
Route::get('users/import', [UserController::class, 'importcreated'])->name('users.import');
Route::post('users/import', [UserController::class, 'import'])->name('users.import');
Route::get('users/export', [UserController::class, 'exportTemplate'])->name('users.export');