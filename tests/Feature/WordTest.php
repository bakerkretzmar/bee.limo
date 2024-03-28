<?php

use App\Models\Word;

test('infers attributes when creating', function () {
    $word = Word::create(['word' => 'confounding']);

    $this->assertSame(['c', 'd', 'f', 'g', 'i', 'n', 'o', 'u'], $word->letters);
});

test('can get score attribute', function () {
    $word = Word::create(['word' => 'word']);
    $foolish = Word::create(['word' => 'foolish']);
    $immobility = Word::create(['word' => 'immobility']);

    $this->assertSame(1, $word->score);
    $this->assertSame(7, $foolish->score);
    $this->assertSame(10, $immobility->score);
});

test('can sum scores', function () {
    Word::create(['word' => 'word']);
    Word::create(['word' => 'foolish']);
    Word::create(['word' => 'immobility']);

    $this->assertSame(18, Word::all()->sum('score'));
});
