<?php

namespace Tests\Unit\Support;

use App\Word;
use App\Support\WordImporter;
use Tests\TestCase;

class WordImporterTest extends TestCase
{
    /** @test */
    public function can_import_words_from_txt_file()
    {
        (new WordImporter(base_path() . '/tests/_fixtures/words.txt'))->import();

        $this->assertEqualsCanonicalizing(
            ['three', 'four', 'five', 'seven', 'eight', 'nine'],
            Word::pluck('word')->all()
        );
    }

    /** @test */
    public function returns_count_of_imported_words()
    {
        // Note: this is the count of valid words processed by the importer.
        // It may not match the number of words in the database, because it
        // isn't aware of duplicates.

        $count = (new WordImporter(base_path() . '/tests/_fixtures/words.txt'))->import();

        $this->assertSame(7, $count);
    }
}
