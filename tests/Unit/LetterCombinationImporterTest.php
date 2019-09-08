<?php

namespace Tests\Unit;

use App\LetterCombination;
use App\Support\LetterCombinationImporter;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

class LetterCombinationImporterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_import_letters_from_txt_file()
    {
        (new LetterCombinationImporter(__DIR__ . '/../__fixtures__/letters.txt'))->import();

        dump(LetterCombination::all());

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
}
