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
}
