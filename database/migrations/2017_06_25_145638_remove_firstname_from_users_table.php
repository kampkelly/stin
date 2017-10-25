<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFirstnameFromUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('firstname');
             $table->dropColumn('lastname');
             $table->dropColumn('name');
             $table->string('fullname')->nullable();
             $table->tinyInteger('verified')->default(0);
             $table->string('verification_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('firstname');
             $table->string('lastname');
             $table->string('name');
             $table->dropColumn('fullname');
             $table->dropColumn('verified');
             $table->dropColumn('verification_token');
        });
    }
}
