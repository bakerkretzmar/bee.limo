<?php

// middleware(['auth'])->
Route::middleware([])->group(function () {

    Route::get('stats', [
        'as' => 'stats',
        'uses' => StatsController::class,
    ]);

    Route::get('settings', [
        'as' => 'settings',
        'uses' => SettingsController::class . '@get',
    ]);

    Route::post('settings', [
        'as' => 'settings',
        'uses' => SettingsController::class . '@set',
    ]);

});

