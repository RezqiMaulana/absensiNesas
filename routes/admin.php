<?php
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BuildingController;
use App\Http\Controllers\admin\TeachersController;


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('users',UserController::class)->except("show");
Route::get('users/import', [UserController::class, 'importcreated'])->name('users.import');
Route::post('users/import', [UserController::class, 'import'])->name('users.import');
Route::get('users/export', [UserController::class, 'exportTemplate'])->name('users.export');
Route::resource('buildings', BuildingController::class)->except("show");


Route::resource('teachers', TeachersController::class)->except("show");
Route::get('teachers/import', [TeachersController::class, 'importcreated'])->name('teachers.import');
Route::post('teachers/import', [TeachersController::class, 'import'])->name('teachers.import');
Route::get('teachers/export', [TeachersController::class, 'exportTemplate'])->name('teachers.export');

