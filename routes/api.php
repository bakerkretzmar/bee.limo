<?php

use App\Http\Controllers\{
    Auth\LoginController,
    Auth\RegisterController,
};

Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('register', [RegisterController::class, 'register'])->name('register');


// middleware(['auth'])->
// Route::middleware([])->group(function () {

//     Route::get('stats', [
//         'as' => 'stats',
//         'uses' => StatsController::class,
//     ]);

//     Route::get('settings', [
//         'as' => 'settings',
//         'uses' => SettingsController::class . '@get',
//     ]);

//     Route::post('settings', [
//         'as' => 'settings',
//         'uses' => SettingsController::class . '@set',
//     ]);

// });

