<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePuzzlesTable extends Migration
{
    public function up()
    {
        Schema::create('puzzles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('string')->unique();
            $table->string('initial');
            $table->json('others');
            $table->json('letters');
            $table->bigInteger('letter_combination_id');
            $table->timestamp('analyzed_at')->nullable();
            $table->timestamps();
        });
    }
}
