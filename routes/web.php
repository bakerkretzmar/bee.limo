<?php

use App\Http\Controllers\AppController;
// use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PuzzleController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

// Auth
Route::get('login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::get('register', [RegisterController::class, 'show'])->middleware('guest')->name('register');

// App
Route::get('/', [AppController::class, 'splash'])->name('splash');
Route::get('about', [AppController::class, 'about'])->name('about');
Route::get('account', [AppController::class, 'account'])->name('account');

// Puzzles
Route::get('play', [PuzzleController::class, 'index'])->middleware(['auth'])->name('puzzles');
Route::get('play/random', [PuzzleController::class, 'random'])->name('puzzles.random');
Route::get('play/{puzzle}', [PuzzleController::class, 'show'])->name('puzzles.show');

// Route::get('dash', DashboardController::class)->middleware(['auth'])->name('dashboard');
