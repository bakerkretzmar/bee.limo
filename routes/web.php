<?php

Route::get('/', [
    'as' => 'app',
    'uses' => AppController::class,
]);
