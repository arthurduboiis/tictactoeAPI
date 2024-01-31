<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastUpdatedToRankingTable extends Migration
{
    public function up()
    {
        Schema::table('ranking', function (Blueprint $table) {
            $table->timestamp('last_updated')->nullable();
        });
    }

    public function down()
    {
        Schema::table('ranking', function (Blueprint $table) {
            $table->dropColumn('last_updated');
        });
    }
}
