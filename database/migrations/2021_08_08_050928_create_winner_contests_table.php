<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWinnerContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('winner_contests', function (Blueprint $table) {
            $table->id();
            $table->integer('contest_id');
            $table->integer('user_id');
            $table->integer('user_id_worker');
            $table->string('title');
            $table->string('filecontest');
            $table->string('logotext')->nullable();
            $table->string('logo')->nullable();
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
        Schema::dropIfExists('winner_contests');
    }
}
