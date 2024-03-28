<?php

namespace Tests\Unit;

use App\Word;
use Tests\TestCase;

class WordTest extends TestCase
{
    /** @test */
    public function infers_attributes_when_creating()
    {
        $word = Word::create(['word' => 'confounding']);

        $this->assertSame(['c', 'd', 'f', 'g', 'i', 'n', 'o', 'u'], $word->letters);
    }

    /** @test */
    public function can_get_score_attribute()
    {
        $word = Word::create(['word' => 'word']);
        $foolish = Word::create(['word' => 'foolish']);
        $immobility = Word::create(['word' => 'immobility']);

        $this->assertSame(1, $word->score);
        $this->assertSame(7, $foolish->score);
        $this->assertSame(10, $immobility->score);
    }

    /** @test */
    public function can_sum_scores()
    {
        Word::create(['word' => 'word']);
        Word::create(['word' => 'foolish']);
        Word::create(['word' => 'immobility']);

        $this->assertSame(18, Word::all()->sum('score'));
    }
}
