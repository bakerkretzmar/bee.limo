<?php

use App\Http\Controllers\{
    AppController,
    DashboardController,
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
Route::get('play', [PuzzleController::class, 'index'])->middleware(['auth'])->name('puzzles');
Route::get('play/{puzzle}', [PuzzleController::class, 'show'])->middleware(['auth'])->name('puzzles.show');
