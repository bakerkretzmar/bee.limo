<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/play';

    public function show()
    {
        return inertia('Register');
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
            'password' => $data['password'],
        ]);
    }
}
