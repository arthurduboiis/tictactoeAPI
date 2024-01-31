<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameTable extends Migration
{
    public function up()
    {
        Schema::create('game', function (Blueprint $table) {
            $table->id('gameID');
            $table->unsignedBigInteger('userID_joueur_1');
            $table->unsignedBigInteger('userID_joueur_2');
            $table->string('state', 50);
            $table->unsignedBigInteger('win');
            $table->unsignedBigInteger('loose');
            $table->boolean('equal')->default(0);
            $table->foreign('userID_joueur_1')->references('userID')->on('users');
            $table->foreign('userID_joueur_2')->references('userID')->on('users');
            $table->foreign('win')->references('userID')->on('users');
            $table->foreign('loose')->references('userID')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('game');
    }
}
