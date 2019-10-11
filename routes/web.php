<?php

use App\Http\Controllers\{
    AppController,
    DashboardController,
    PlayController,
    PuzzleController,
    Auth\LoginController,
    Auth\RegisterController,
};

Route::get('/', AppController::class);

Route::get('dash', DashboardController::class)->name('dashboard');

Route::get('play', PlayController::class)->name('play');
Route::get('play/{puzzle}', PuzzleController::class)->name('puzzle');

Route::get('login', [LoginController::class, 'show'])->name('login');
Route::get('register', [RegisterController::class, 'show'])->name('register');

// $this->emailVerification();
