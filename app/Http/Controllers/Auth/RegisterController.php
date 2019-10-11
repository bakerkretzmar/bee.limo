<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Hash;
use Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Routing\Controller;

use Inertia\Inertia;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/play';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function show()
    {
        return Inertia::render('Register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:10'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
