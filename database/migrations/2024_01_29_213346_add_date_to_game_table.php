<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateToGameTable extends Migration
{
    public function up()
    {
        Schema::table('game', function (Blueprint $table) {
            $table->timestamp('date')->nullable();
        });
    }

    public function down()
    {
        Schema::table('game', function (Blueprint $table) {
            $table->dropColumn('date');
        });
    }
}
