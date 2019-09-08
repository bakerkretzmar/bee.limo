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
            $table->json('letters');
            $table->json('others');
            $table->bigInteger('letter_combination_id');
            $table->json('analysis')->nullable();
            $table->timestamp('analyzed_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }
}
