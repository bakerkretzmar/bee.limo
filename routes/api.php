<?php

use App\Http\Controllers\{
    Api\GameController,
    Auth\LoginController,
    Auth\RegisterController,
};

// Auth
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('register', [RegisterController::class, 'register'])->name('register');

// Puzzles
Route::get('game/{puzzle}', [GameController::class, 'show'])->middleware(['auth'])->name('game');
Route::post('game/{puzzle}', [GameController::class, 'update'])->middleware(['auth'])->name('game');

// Route::get('stats', StatsController::class)->middleware(['auth'])->name('stats');
// Route::get('settings', [SettingsController::class, 'get'])->middleware(['auth'])->name('settings');
// Route::post('settings', [SettingsController::class, 'set'])->middleware(['auth'])->name('settings');
