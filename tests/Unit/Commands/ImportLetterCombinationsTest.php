<?php

namespace Tests\Unit\Commands;

use App\LetterCombination;
use Tests\TestCase;

class ImportLetterCombinationsTest extends TestCase
{
    /** @test */
    public function can_import_letter_combinations_from_txt_file()
    {
        $this->artisan('import:letters ' . base_path() . '/tests/_fixtures/letters_1.txt');

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
    }

    /** @test */
    public function skips_letter_combinations_with_no_vowels()
    {
        $this->artisan('import:letters ' . base_path() . '/tests/_fixtures/letters_2.txt');

        $this->assertEqualsCanonicalizing(
            [
                ['a', 'b', 'c', 'd', 'e', 'g'],
                ['a', 'b', 'c', 'd', 'e', 'k'],
            ],
            LetterCombination::pluck('letters')->all()
        );
    }

    /** @test */
    public function skips_letter_combinations_with_two_vowels()
    {
        $this->artisan('import:letters ' . base_path() . '/tests/_fixtures/letters_3.txt');

        $this->assertEqualsCanonicalizing(
            [
                ['a', 'b', 'c', 'd', 'e', 'g'],
                ['a', 'b', 'c', 'd', 'e', 'k'],
            ],
            LetterCombination::pluck('letters')->all()
        );
    }

    /** @test */
    public function skips_letter_combinations_with_letter_s()
    {
        $this->artisan('import:letters ' . base_path() . '/tests/_fixtures/letters_4.txt');

        $this->assertEqualsCanonicalizing(
            [
                ['a', 'b', 'c', 'd', 'e', 'g'],
                ['a', 'b', 'c', 'd', 'e', 'k'],
            ],
            LetterCombination::pluck('letters')->all()
        );
    }
}
