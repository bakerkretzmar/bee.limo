<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuzzleUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('puzzle_user', function (Blueprint $table) {
            $table->unsignedBigInteger('puzzle_id');
            $table->unsignedBigInteger('user_id');
            $table->json('found_word_ids')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }
}
