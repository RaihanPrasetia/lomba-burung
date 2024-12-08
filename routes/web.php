<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\juriController;
use App\Http\Controllers\penilaianController;
use App\Http\Controllers\perlombaanController;
use App\Http\Controllers\resultController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('pages.user.index');
})->name('dashboard.user');

Route::get('/login', [authController::class, 'index'])->name('login');
Route::post('login', [authController::class, 'login'])->name('login.post');
Route::get('/logout', [authController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');
    Route::get('/result', [resultController::class, 'index'])->name('result.index');
    Route::get('/penilaian', [penilaianController::class, 'index'])->name('penilaian.index');
    Route::get('/juri', [juriController::class, 'index'])->name('juri.index');
    Route::get('/perlombaan', [perlombaanController::class, 'index'])->name('perlombaan.index');
});
