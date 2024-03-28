<?php

use App\Models\LetterCombination;

test('can import letter combinations from txt file', function () {
    $this->artisan('import:letters ' . base_path() . '/tests/fixtures/letters_1.txt');

    $this->assertEqualsCanonicalizing(
        [
            ['a', 'b', 'c', 'd', 'e', 'f'],
            ['a', 'b', 'c', 'd', 'e', 'g'],
            ['a', 'f', 'c', 'e', 'v', 'g'],
            ['a', 'b', 'c', 'd', 'e', 'j'],
            ['a', 'b', 'c', 'd', 'e', 'k'],
        ],
        LetterCombination::pluck('letters')->all()
    );
});

test('skips letter combinations with no vowels', function () {
    $this->artisan('import:letters ' . base_path() . '/tests/fixtures/letters_2.txt');

    $this->assertEqualsCanonicalizing(
        [
            ['a', 'b', 'c', 'd', 'e', 'g'],
            ['a', 'b', 'c', 'd', 'e', 'k'],
        ],
        LetterCombination::pluck('letters')->all()
    );
});

test('skips letter combinations with two vowels', function () {
    $this->artisan('import:letters ' . base_path() . '/tests/fixtures/letters_3.txt');

    $this->assertEqualsCanonicalizing(
        [
            ['a', 'b', 'c', 'd', 'e', 'g'],
            ['a', 'b', 'c', 'd', 'e', 'k'],
        ],
        LetterCombination::pluck('letters')->all()
    );
});

test('skips letter combinations with letter s', function () {
    $this->artisan('import:letters ' . base_path() . '/tests/fixtures/letters_4.txt');

    $this->assertEqualsCanonicalizing(
        [
            ['a', 'b', 'c', 'd', 'e', 'g'],
            ['a', 'b', 'c', 'd', 'e', 'k'],
        ],
        LetterCombination::pluck('letters')->all()
    );
});
