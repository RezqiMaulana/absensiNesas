<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    // Jika user sudah login, arahkan ke dashboard masing-masing
    if (Auth::check()) {
        $role = Auth::user()->role;

        if ($role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($role === 'piket') {
            return redirect('/piket/dashboard');
        } else {
            return redirect('/absen-kelas');
        }
    }

    // Jika belum login, tampilkan halaman login (bukan welcome)
    return redirect()->route('login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {

// Group untuk Admin
    Route::middleware([ 'role:admin'])->prefix('admin')->name("admin.")->group(function () {
        
    require __DIR__.'/admin.php';

    });

    // Group untuk Piket (Bisa melihat semua tapi tidak edit master)
    Route::middleware(['role:admin,piket'])->prefix('piket')->name("piket.")->group(function () {
    
    require __DIR__.'/piket.php';

    });

    // Group untuk Wali Kelas & Perwakilan Siswa (Hanya akses kelasnya sendiri)
    Route::middleware(['role:wali_kelas,perwakilan_siswa'])->group(function () {
        require __DIR__.'/walas.php';

    });




    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});






require __DIR__.'/auth.php';
