<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

// Auth
Route::post('login', [LoginController::class, 'login'])->middleware('guest')->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('register', [RegisterController::class, 'register'])->middleware('guest')->name('register');

// Puzzles
Route::get('game/{puzzle}', [GameController::class, 'show'])->middleware(['auth'])->name('game');
Route::post('game/{puzzle}', [GameController::class, 'update'])->middleware(['auth'])->name('game');

// Route::get('stats', StatsController::class)->middleware(['auth'])->name('stats');
// Route::get('settings', [SettingsController::class, 'get'])->middleware(['auth'])->name('settings');
// Route::post('settings', [SettingsController::class, 'set'])->middleware(['auth'])->name('settings');
