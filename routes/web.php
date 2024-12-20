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
use App\Models\Participant;
use Illuminate\Support\Facades\Route;


Route::get('/', [guestController::class, 'index'])->name('home');
Route::get('/rank', [guestController::class, 'rank'])->name('rank.index');
Route::get('/rank/{classId}', [guestController::class, 'show'])->name('rank.show');


Route::get('/login', [authController::class, 'index'])->name('login');
Route::post('login', [authController::class, 'login'])->name('login.post');
Route::get('/logout', [authController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');

    // Routes Perlombaan
    Route::resource('perlombaan', PerlombaanController::class);
    Route::resource('class', classesController::class);
    Route::resource('/criteria', criteriaController::class);
    Route::resource('/juri', JuriController::class);
    Route::resource('/peserta', pesertaController::class);
    Route::resource('/penilaian', penilaianController::class);
    Route::post('/penilaian/{participantId}/status', [penilaianController::class, 'updateStatus'])->name('participant.status')->middleware('auth');

    Route::get('/score', [scoreController::class, 'index'])->name('score.index');
    Route::get('/get-classes', [PesertaController::class, 'getClasses']);
});
