<?php

if (!function_exists('letters')) {
    function letters()
    {
        return ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
    }
}

if (!function_exists('vowels')) {
    function vowels()
    {
        return ['a', 'e', 'i', 'o', 'u'];
    }
}

if (!function_exists('get_vowels')) {
    function get_vowels(array $letters)
    {
        return array_values(array_intersect($letters, vowels()));
    }
}

if (!function_exists('consonants')) {
    function consonants()
    {
        return ['b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'];
    }
}

if (!function_exists('get_consonants')) {
    function get_consonants(array $letters)
    {
        return array_values(array_intersect($letters, consonants()));
    }
}
