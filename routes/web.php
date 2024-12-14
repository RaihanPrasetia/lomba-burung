<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\classesController;
use App\Http\Controllers\criteriaController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\guestController;
use App\Http\Controllers\juriController;
use App\Http\Controllers\penilaianController;
use App\Http\Controllers\perlombaanController;
use App\Http\Controllers\pesertaController;
use App\Http\Controllers\scoreController;
use Illuminate\Support\Facades\Route;


Route::get('/', [guestController::class, 'index'])->name('home');


Route::get('/login', [authController::class, 'index'])->name('login');
Route::post('login', [authController::class, 'login'])->name('login.post');
Route::get('/logout', [authController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');

    // Routes Perlombaan
    Route::resource('perlombaan', PerlombaanController::class);
    Route::resource('class', classesController::class);
    Route::resource('/criteria', criteriaController::class);
    Route::resource('/penilaian', penilaianController::class);
    Route::get('/peserta', [pesertaController::class, 'index'])->name('peserta.index');
    Route::get('/juri', [juriController::class, 'index'])->name('juri.index');


    Route::get('/score', [scoreController::class, 'index'])->name('score.index');


    Route::resource('juris', JuriController::class);
    Route::post('/juri', [JuriController::class, 'store'])->name('juri.store');
});
