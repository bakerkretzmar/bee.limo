<?php

Route::get('/', [
    'as' => 'app',
    'uses' => AppController::class,
]);

Route::get('/dash', [
    'as' => 'dashboard',
    'uses' => DashboardController::class,
]);

Route::get('/play', [
    'as' => 'play',
    'uses' => PlayController::class,
]);
