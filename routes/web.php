<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PuzzleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Auth
Route::get('login', [LoginController::class, 'show'])->name('login');
Route::get('register', [RegisterController::class, 'show'])->name('register');
// $this->emailVerification();

// App
Route::get('/', [AppController::class, 'splash'])->name('splash');
Route::get('about', [AppController::class, 'about'])->name('about');
Route::get('dash', DashboardController::class)->middleware(['auth'])->name('dashboard');

// Puzzles
Route::get('play', [PuzzleController::class, 'index'])->middleware(['auth'])->name('puzzles');
Route::get('play/{puzzle}', [PuzzleController::class, 'show'])->middleware(['auth'])->name('puzzles.show');
