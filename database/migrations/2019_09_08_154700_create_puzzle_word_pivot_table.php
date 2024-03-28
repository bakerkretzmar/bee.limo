<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuzzleWordPivotTable extends Migration
{
    public function up()
    {
        Schema::create('puzzle_word', function (Blueprint $table) {
            $table->bigInteger('puzzle_id');
            $table->bigInteger('word_id');
        });
    }
}
