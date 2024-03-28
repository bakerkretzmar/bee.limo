<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Model::unguard();

        Arr::macro('letters', function () {
            return ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
        });

        Arr::macro('vowels', function (array $letters) {
            return array_values(array_intersect($letters, ['a', 'e', 'i', 'o', 'u']));
        });

        Arr::macro('consonants', function (array $letters) {
            return array_values(array_intersect($letters, ['b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z']));
        });
    }
}
