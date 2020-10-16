<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Routing\Controller;
use Inertia\Inertia;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/play';

    public function show()
    {
        return Inertia::render('Login');
    }
}
