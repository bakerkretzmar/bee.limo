<?php

use App\Http\Controllers\{
    AppController,
    DashboardController,
    PlayController,
    PuzzleController,
    Auth\LoginController,
    Auth\RegisterController,
};

// Auth
Route::get('login', [LoginController::class, 'show'])->name('login');
Route::get('register', [RegisterController::class, 'show'])->name('register');
// $this->emailVerification();

// App
Route::get('/', AppController::class);
Route::get('dash', DashboardController::class)->middleware(['auth'])->name('dashboard');

// Puzzles
Route::get('play', PlayController::class)->middleware(['auth'])->name('play');
Route::get('play/{puzzle}', PuzzleController::class)->middleware(['auth'])->name('puzzle');
