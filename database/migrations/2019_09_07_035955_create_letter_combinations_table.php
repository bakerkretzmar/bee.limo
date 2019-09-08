<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLetterCombinationsTable extends Migration
{
    public function up()
    {
        Schema::create('letter_combinations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('string')->unique();
            $table->json('letters');
            $table->json('vowels');
            $table->tinyInteger('vowel_count')->index();
            $table->json('consonants');
            $table->timestamps();
        });
    }
}
