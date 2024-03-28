<?php

use App\Models\Puzzle;
use App\Models\Word;

test('infers attributes when creating', function () {
    $puzzle = Puzzle::create([
        'letters' => ['a', 'b', 'c', 'd', 'e', 'f', 'g'],
        'letter_combination_id' => 1,
    ]);

    $this->assertSame('abcdefg', $puzzle->string);
    $this->assertSame('a', $puzzle->initial);
});

test('can check if pangram exists', function () {
    $puzzle = Puzzle::create([
        'letters' => ['i', 'v', 'e', 't', 'n', 'c', 'z'],
        'letter_combination_id' => 1,
    ]);

    Word::create(['word' => 'incentivize']);

    $this->assertTrue($puzzle->hasPangram());
});

test('can check if pangram doesnt exist', function () {
    $puzzle = Puzzle::create([
        'letters' => ['i', 'v', 'e', 't', 'n', 'c', 'z'],
        'letter_combination_id' => 1,
    ]);

    Word::create(['word' => 'invite']);
    Word::create(['word' => 'incentive']);
    Word::create(['word' => 'zinc']);
    Word::create(['word' => 'incite']);
    Word::create(['word' => 'zoomy']);
    Word::create(['word' => 'accept']);

    $this->assertFalse($puzzle->hasPangram());
});

test('can get pangrams attribute', function () {
    $puzzle = Puzzle::create([
        'letters' => ['i', 'v', 'e', 't', 'n', 'c', 'z'],
        'letter_combination_id' => 1,
    ]);

    $incentivize = Word::create(['word' => 'incentivize']);
    $puzzle->words()->attach($incentivize);

    $this->assertSame(['incentivize'], $puzzle->pangrams->pluck('word')->all());

    $inventicize = Word::create(['word' => 'inventicize']);
    $puzzle->words()->attach($inventicize);
    $puzzle->refresh();

    $this->assertSame(['incentivize', 'inventicize'], $puzzle->pangrams->pluck('word')->all());
});

test('fails analysis if no pangram', function () {
    $puzzle = Puzzle::create([
        'letters' => ['i', 'v', 'e', 't', 'n', 'c', 'z'],
        'letter_combination_id' => 1,
    ]);

    Word::create(['word' => 'invite']);
    Word::create(['word' => 'incentive']);
    Word::create(['word' => 'zinc']);
    Word::create(['word' => 'incite']);
    Word::create(['word' => 'zoomy']);
    Word::create(['word' => 'accept']);

    $puzzle->solve();

    $this->assertTrue($puzzle->solved);
    $this->assertSame(
        [
            'result' => 'fail',
            'summary' => 'No pangram.',
        ],
        $puzzle->analysis
    );
    $this->assertTrue($puzzle->trashed());
});

test('fails analysis if fewer than fifteen words', function () {
    $puzzle = Puzzle::create([
        'letters' => ['i', 'v', 'e', 't', 'n', 'c', 'z'],
        'letter_combination_id' => 1,
    ]);

    Word::create(['word' => 'invite']);
    Word::create(['word' => 'incentive']);
    Word::create(['word' => 'incentivize']);
    Word::create(['word' => 'intent']);
    Word::create(['word' => 'nice']);
    Word::create(['word' => 'nine']);
    Word::create(['word' => 'cite']);
    Word::create(['word' => 'citizen']);
    Word::create(['word' => 'civic']);
    Word::create(['word' => 'entice']);
    Word::create(['word' => 'evict']);
    Word::create(['word' => 'evince']);
    Word::create(['word' => 'zinc']);
    Word::create(['word' => 'incite']);
    Word::create(['word' => 'zoomy']);
    Word::create(['word' => 'accept']);

    $puzzle->solve();

    $this->assertTrue($puzzle->solved);
    $this->assertSame('fail', $puzzle->analysis['result']);
    $this->assertSame('Fewer than 20 words.', $puzzle->analysis['summary']);
    $this->assertSame(14, $puzzle->analysis['word_count']);
    $this->assertTrue($puzzle->trashed());
});

test('fails analysis if any letters only in pangram', function () {
    $puzzle = Puzzle::create([
        'letters' => ['i', 'v', 'e', 't', 'n', 'c', 'z'],
        'letter_combination_id' => 1,
    ]);

    Word::create(['word' => 'invite']);
    Word::create(['word' => 'incentive']);
    Word::create(['word' => 'incentivize']);
    Word::create(['word' => 'intent']);
    Word::create(['word' => 'nice']);
    Word::create(['word' => 'nine']);
    Word::create(['word' => 'cite']);
    Word::create(['word' => 'cititen']);
    Word::create(['word' => 'civic']);
    Word::create(['word' => 'entice']);
    Word::create(['word' => 'evict']);
    Word::create(['word' => 'evince']);
    Word::create(['word' => 'tinc']);
    Word::create(['word' => 'incite']);
    Word::create(['word' => 'zoomy']);
    Word::create(['word' => 'accept']);
    Word::create(['word' => 'niti']);
    Word::create(['word' => 'itni']);
    Word::create(['word' => 'invent']);
    Word::create(['word' => 'vicit']);
    Word::create(['word' => 'vincinti']);
    Word::create(['word' => 'tivic']);

    $puzzle->solve();

    $this->assertTrue($puzzle->solved);
    $this->assertSame('fail', $puzzle->analysis['result']);
    $this->assertSame('Some letters only present in pangrams.', $puzzle->analysis['summary']);
    $this->assertSame(20, $puzzle->analysis['word_count']);
    $this->assertTrue($puzzle->trashed());
});

test('passes analysis if valid', function () {
    $puzzle = Puzzle::create([
        'letters' => ['i', 'v', 'e', 't', 'n', 'c', 'z'],
        'letter_combination_id' => 1,
    ]);

    $word1 = Word::create(['word' => 'invite']);
    Word::create(['word' => 'incentive']);
    Word::create(['word' => 'incentivize']);
    Word::create(['word' => 'intent']);
    Word::create(['word' => 'nice']);
    Word::create(['word' => 'nine']);
    Word::create(['word' => 'cite']);
    Word::create(['word' => 'citizen']);
    Word::create(['word' => 'civic']);
    Word::create(['word' => 'entice']);
    Word::create(['word' => 'evict']);
    Word::create(['word' => 'evince']);
    Word::create(['word' => 'zinc']);
    Word::create(['word' => 'incite']);
    Word::create(['word' => 'zoomy']);
    Word::create(['word' => 'accept']);
    Word::create(['word' => 'ziti']);
    Word::create(['word' => 'itzi']);
    Word::create(['word' => 'invent']);
    Word::create(['word' => 'vizit']);
    Word::create(['word' => 'vinzinti']);
    Word::create(['word' => 'tiviz']);

    $puzzle->solve();

    $this->assertTrue($puzzle->solved);
    $this->assertEqualsCanonicalizing(
        [...range($word1->id, $word1->id + 13), ...range($word1->id + 16, $word1->id + 21)],
        $puzzle->words->pluck('id')->all()
    );
    $this->assertSame('pass', $puzzle->analysis['result']);
    $this->assertSame(20, $puzzle->analysis['word_count']);
    $this->assertSame(5.75, $puzzle->analysis['avg_word_length']);
    $this->assertSame(11, $puzzle->analysis['max_word_length']);
    $this->assertFalse($puzzle->trashed());
});
