<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\GameController;
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

Route::prefix('api')->name('api:')->group(function () {
    // Auth
    Route::post('login', [LoginController::class, 'login'])->middleware('guest')->name('login');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('register', [RegisterController::class, 'register'])->middleware('guest')->name('register');

    // Puzzles
    Route::get('game/{puzzle}', [GameController::class, 'show'])->middleware(['auth'])->name('games.show');
    Route::post('game/{puzzle}', [GameController::class, 'update'])->middleware(['auth'])->name('games.update');

    // Route::get('stats', StatsController::class)->middleware(['auth'])->name('stats');
    // Route::get('settings', [SettingsController::class, 'get'])->middleware(['auth'])->name('settings');
    // Route::post('settings', [SettingsController::class, 'set'])->middleware(['auth'])->name('settings');
});
