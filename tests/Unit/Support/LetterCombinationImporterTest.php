<?php

namespace Tests\Unit\Support;

use App\LetterCombination;
use App\Support\LetterCombinationImporter;
use Tests\TestCase;

class LetterCombinationImporterTest extends TestCase
{
    /** @test */
    public function can_import_letter_combinations_from_txt_file()
    {
        (new LetterCombinationImporter(base_path() . '/tests/_fixtures/letters_1.txt'))->import();

        $this->assertEqualsCanonicalizing(
            [
                ['a', 'b', 'c', 'd', 'e', 'f'],
                ['a', 'b', 'c', 'd', 'e', 'g'],
                ['a', 'b', 'c', 'd', 'e', 'i'],
                ['a', 'b', 'c', 'd', 'e', 'j'],
                ['a', 'b', 'c', 'd', 'e', 'k'],
            ],
            LetterCombination::pluck('letters')->all()
        );
    }

    /** @test */
    public function returns_count_of_imported_letter_combinations()
    {
        $count = (new LetterCombinationImporter(base_path() . '/tests/_fixtures/letters_1.txt'))->import();

        $this->assertSame(5, $count);
    }

    /** @test */
    public function skips_letter_combinations_with_no_vowels()
    {
        (new LetterCombinationImporter(base_path() . '/tests/_fixtures/letters_2.txt'))->import();

        $this->assertEqualsCanonicalizing(
            [
                ['a', 'b', 'c', 'd', 'e', 'g'],
                ['a', 'e', 'i', 'o', 'u', 'r'],
                ['a', 'b', 'c', 'd', 'e', 'k'],
            ],
            LetterCombination::pluck('letters')->all()
        );
    }
}
