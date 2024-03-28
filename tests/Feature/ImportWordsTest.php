<?php

use App\Models\Word;

test('can_import_words_from_txt_file', function () {
    $this->artisan('import:words ' . base_path() . '/tests/fixtures/words.txt');

    $this->assertEqualsCanonicalizing(
        ['three', 'four', 'five', 'seven', 'eight', 'nine'],
        Word::pluck('word')->all()
    );
});
