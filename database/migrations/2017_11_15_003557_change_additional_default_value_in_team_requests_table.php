<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAdditionalDefaultValueInTeamRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('team_requests', function (Blueprint $table) {
            $table->string('additional')->nullable()->default('None')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('team_requests', function (Blueprint $table) {
            $table->string('additional')->nullable()->default(NULL)->change();
        });
    }
}
