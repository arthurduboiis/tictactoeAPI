<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRankingTable extends Migration
{
    public function up()
    {
        Schema::create('ranking', function (Blueprint $table) {
            $table->unsignedBigInteger('userID');
            $table->primary('userID');
            $table->integer('win')->default(0);
            $table->integer('lose')->default(0);
            $table->integer('equal')->default(0);
            $table->integer('score')->default(0);
            $table->foreign('userID')->references('userID')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ranking');
    }
}
