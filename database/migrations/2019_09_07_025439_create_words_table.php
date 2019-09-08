<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWordsTable extends Migration
{
    public function up()
    {
        Schema::create('words', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('word')->unique();
            $table->string('letter_1')->index();
            $table->string('letter_2')->index();
            $table->json('letters');
            $table->timestamps();
        });
    }
}
