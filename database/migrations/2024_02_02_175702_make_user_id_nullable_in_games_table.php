<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('game', function (Blueprint $table) {
            $table->unsignedBigInteger('userID_joueur_1')->nullable()->change();
            $table->unsignedBigInteger('userID_joueur_2')->nullable()->change();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('game', function (Blueprint $table) {
            //
        });
    }
};
