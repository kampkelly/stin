<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDefaultValuesInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('address')->nullable()->default('No information!')->change();
            $table->string('state')->nullable()->default('No information!')->change();
            $table->string('country')->nullable()->default('No information!')->change();
            $table->string('website')->nullable()->default('No information!')->change();
            $table->string('facebook')->nullable()->default('No information!')->change();
            $table->string('linkedin')->nullable()->default('No information!')->change();
            $table->string('twitter')->nullable()->default('No information!')->change();
            $table->string('bio')->nullable()->default('No information!')->change();
            $table->string('education')->nullable()->default('No information!')->change();
            $table->string('profession')->nullable()->default('No information!')->change();
            $table->string('interests')->nullable()->default('No information!')->change();
            $table->string('gender')->nullable()->default('No information!')->change();
            $table->string('contacts')->nullable()->default('No information!')->change();
            $table->string('company_name')->nullable()->default('No information!')->change();
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
            $table->string('address')->nullable()->default(NULL)->change();
            $table->string('state')->nullable()->default(NULL)->change();
            $table->string('country')->nullable()->default(NULL)->change();
            $table->string('website')->nullable()->default(NULL)->change();
            $table->string('facebook')->nullable()->default(NULL)->change();
            $table->string('linkedin')->nullable()->default(NULL)->change();
            $table->string('twitter')->nullable()->default(NULL)->change();
            $table->string('bio')->nullable()->default(NULL)->change();
            $table->string('education')->nullable()->default(NULL)->change();
            $table->string('profession')->nullable()->default(NULL)->change();
            $table->string('interests')->nullable()->default(NULL)->change();
            $table->string('gender')->nullable()->default(NULL)->change();
            $table->string('contacts')->nullable()->default(NULL)->change();
            $table->string('company_name')->nullable()->default(NULL)->change();
        });
    }
}
