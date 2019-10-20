<?php

use App\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Jacob Baker-Kretzmar',
            'email' => 'jacobtbk@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
