
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\SkemaSertifikasiController;
use App\Models\Peserta;
use App\Models\SkemaSertifikasi;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

// Register
Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');

// Route yang memerlukan login
Route::middleware('auth')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'jumlahPeserta' => Peserta::count(),
            'jumlahSkema' => SkemaSertifikasi::count(),
        ]);
    })->middleware('role:admin')->name('dashboard');

    // Dashboard User
    Route::get('/user-dashboard', function () {
        return view('user-dashboard');
    })->middleware('role:user')->name('user.dashboard');

    // Fitur khusus Admin
    Route::middleware('role:admin')->group(function () {

        // Data Peserta
        Route::resource('peserta', PesertaController::class);

        // Data Skema Sertifikasi
        Route::resource('skema-sertifikasi', SkemaSertifikasiController::class);
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
