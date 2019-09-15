<?php

namespace App\Http\Controllers\Api;

class SettingsController
{
    public function get()
    {
        return response()->json([
            'auto_puzzle_generation' => true,
            'auto_puzzle_analysis' => false,
        ]);
    }

    public function set()
    {
        return response()->json(['succes' => true]);
    }
}
