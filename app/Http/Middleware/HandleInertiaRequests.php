<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'user' => fn () => $request->user(),
            'flash' => fn () => $request->session()->only(['success', 'error']),
        ]);
    }
}
