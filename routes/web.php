<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\SkemaSertifikasiController;
use App\Models\Peserta;
use App\Models\SkemaSertifikasi;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('peserta.index');
});

//Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

//memproses
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

//Perlu login
Route::middleware('auth')->group(function (){

    //Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'jumlahPeserta' => Peserta::count(),
            'jumlahSkema' => SkemaSertifikasi::count(),
        ]);
    })->name('dashboard');

    //data peserta
    Route::resource('peserta', PesertaController::class);

    //data skema sertif
    Route::resource('skema-sertifikasi', SkemaSertifikasiController::class);

    //logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
