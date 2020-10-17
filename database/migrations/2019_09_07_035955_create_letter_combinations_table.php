<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLetterCombinationsTable extends Migration
{
    public function up()
    {
        Schema::create('letter_combinations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('string')->unique();
            $table->json('letters');
            $table->json('vowels');
            $table->json('consonants');
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
        });
    }
}
