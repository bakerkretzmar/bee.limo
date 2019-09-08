<?php

namespace Tests\Unit;

use App\Word;
use App\Support\WordImporter;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

class WordImporterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_import_words_from_txt_file()
    {
        (new WordImporter(__DIR__ . '/../__fixtures__/words.txt'))->import();

        $this->assertEqualsCanonicalizing(
            ['three', 'four', 'five', 'seven', 'eight', 'nine'],
            Word::pluck('word')->all()
        );
    }
}
