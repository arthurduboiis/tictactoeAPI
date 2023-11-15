<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoveTable extends Migration
{
    public function up()
    {
        Schema::create('move', function (Blueprint $table) {
            $table->id('moveID');
            $table->unsignedBigInteger('gameID');
            $table->unsignedBigInteger('userID');
            $table->integer('position_x');
            $table->integer('position_y');
            $table->timestamp('date_move')->useCurrent();
            $table->foreign('gameID')->references('gameID')->on('game');
            $table->foreign('userID')->references('userID')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('move');
    }
}
