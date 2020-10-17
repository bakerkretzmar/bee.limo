<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * Defines the props that are shared by default.
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'user'  => fn ()  => $request->user(),
            'flash' => fn () => $request->session()->only(['success', 'error']),
        ]);
    }
}
