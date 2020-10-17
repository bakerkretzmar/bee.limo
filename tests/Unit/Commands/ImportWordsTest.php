<?php

namespace Tests\Unit\Commands;

use App\Word;
use Tests\TestCase;

class ImportWordsTest extends TestCase
{
    /** @test */
    public function can_import_words_from_txt_file()
    {
        $this->artisan('import:words '.base_path().'/tests/_fixtures/words.txt');

        $this->assertEqualsCanonicalizing(
            ['three', 'four', 'five', 'seven', 'eight', 'nine'],
            Word::pluck('word')->all()
        );
    }
}
