<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
