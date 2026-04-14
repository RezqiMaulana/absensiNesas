<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\TeachersController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BuildingController;
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('users',UserController::class)->except("show");
Route::get('users/import', [UserController::class, 'importcreated'])->name('users.import');
Route::post('users/import', [UserController::class, 'import'])->name('users.import');
Route::get('users/export', [UserController::class, 'exportTemplate'])->name('users.export');

Route::resource('teachers', TeachersController::class)->except("show");
Route::get('teachers/import', [TeachersController::class, 'importcreated'])->name('teachers.import');
Route::post('teachers/import', [TeachersController::class, 'import'])->name('teachers.import');
Route::get('teachers/export', [TeachersController::class, 'exportTemplate'])->name('teachers.export');

Route::resource('building', BuildingController::class)->except("show");
Route::get('building/import', [BuildingController::class, 'importcreated'])->name('building.import');
Route::post('building/import', [BuildingController::class, 'import'])->name('building.import');
Route::get('building/export', [BuildingController::class, 'exportTemplate'])->name('building.export');

Route::resource('classes', \App\Http\Controllers\admin\ClassroomController::class)->except("show");
Route::get('classes/import', [\App\Http\Controllers\admin\ClassroomController::class, 'importcreated'])->name('classes.import');
Route::post('classes/import', [\App\Http\Controllers\admin\ClassroomController::class, 'import'])->name('classes.import');
Route::get('classes/export', [\App\Http\Controllers\admin\ClassroomController::class, 'exportTemplate'])->name('classes.export');

Route::resource('exit-permissions', \App\Http\Controllers\admin\ExitPermissionController::class)->except("show");
Route::get('exit-permissions/import', [\App\Http\Controllers\admin\ExitPermissionController::class, 'importcreated'])->name('exit-permissions.import');
Route::post('exit-permissions/import', [\App\Http\Controllers\admin\ExitPermissionController::class, 'import'])->name('exit-permissions.import');
Route::get('exit-permissions/export', [\App\Http\Controllers\admin\ExitPermissionController::class, 'exportTemplate'])->name('exit-permissions.export');
