<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('friendships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('friend_id');
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('userID')->references('userId')->on('users')->onDelete('cascade');
            $table->foreign('friend_id')->references('userId')->on('users')->onDelete('cascade');

            $table->unique(['userID', 'friend_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('friendships');
    }
};
