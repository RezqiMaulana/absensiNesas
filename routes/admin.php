<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StudentController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('users',UserController::class)->except("show");
Route::get('users/import', [UserController::class, 'importcreated'])->name('users.import');
Route::post('users/import', [UserController::class, 'import'])->name('users.import');
Route::get('users/export', [UserController::class, 'exportTemplate'])->name('users.export');


Route::resource('students', StudentController::class)->except("show");
Route::get('students/import', [StudentController::class, 'importcreated'])->name('students.import');
Route::post('students/import', [StudentController::class, 'import'])->name('students.import');
Route::get('students/export', [StudentController::class, 'exportTemplate'])->name('students.export');
