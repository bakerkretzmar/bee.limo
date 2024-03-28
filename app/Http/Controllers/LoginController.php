<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/play';

    public function show()
    {
        return inertia('Login');
    }

    // TODO might be able to remove depending on $request->wantsJson()
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended($this->redirectPath());
    }
}
