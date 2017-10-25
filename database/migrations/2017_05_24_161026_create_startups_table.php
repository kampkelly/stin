<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStartupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('startups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('group_name');
            $table->text('short_desc');
            $table->text('full_desc');
            $table->text('image');
            $table->text('aim');
            $table->text('importance');
            $table->text('achievements');
            $table->text('features');
            $table->integer('category_id');
            $table->integer('user_id');
            $table->string('contacts');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('startups');
    }
}
