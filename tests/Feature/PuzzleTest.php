<?php

namespace Tests\Unit;

use App\Puzzle;
use App\Word;
use Tests\TestCase;

class PuzzleTest extends TestCase
{
    /** @test */
    public function infers_attributes_when_creating()
    {
        $puzzle = Puzzle::create([
            'letters' => ['a', 'b', 'c', 'd', 'e', 'f', 'g'],
            'letter_combination_id' => 1,
        ]);

        $this->assertSame('abcdefg', $puzzle->string);
        $this->assertSame('a', $puzzle->initial);
    }

    /** @test */
    public function can_check_if_pangram_exists()
    {
        $puzzle = Puzzle::create([
            'letters' => ['i', 'v', 'e', 't', 'n', 'c', 'z'],
            'letter_combination_id' => 1,
        ]);

        Word::create(['word' => 'incentivize']);

        $this->assertTrue($puzzle->hasPangram());
    }

    /** @test */
    public function can_check_if_pangram_doesnt_exist()
    {
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
    }

    /** @test */
    public function can_get_pangrams_attribute()
    {
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
    }

    /** @test */
    public function fails_analysis_if_no_pangram()
    {
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
    }

    /** @test */
    public function fails_analysis_if_fewer_than_fifteen_words()
    {
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
    }

    /** @test */
    public function fails_analysis_if_any_letters_only_in_pangram()
    {
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
    }

    /** @test */
    public function passes_analysis_if_valid()
    {
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
        Word::create(['word' => 'ziti']);
        Word::create(['word' => 'itzi']);
        Word::create(['word' => 'invent']);
        Word::create(['word' => 'vizit']);
        Word::create(['word' => 'vinzinti']);
        Word::create(['word' => 'tiviz']);

        $puzzle->solve();

        $this->assertTrue($puzzle->solved);
        $this->assertEqualsCanonicalizing(
            [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 17, 18, 19, 20, 21, 22],
            $puzzle->words->pluck('id')->all()
        );
        $this->assertSame('pass', $puzzle->analysis['result']);
        $this->assertSame(20, $puzzle->analysis['word_count']);
        $this->assertSame(5.75, $puzzle->analysis['avg_word_length']);
        $this->assertSame(11, $puzzle->analysis['max_word_length']);
        $this->assertFalse($puzzle->trashed());
    }
}
