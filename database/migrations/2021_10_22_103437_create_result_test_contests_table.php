<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultTestContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_test_contests', function (Blueprint $table) {
            $table->id();
            $table->integer('contest_id');
            $table->integer('user_id_worker');
            $table->text('title');
            $table->string('filecontest');
            $table->integer('nilai')->nullable();
            $table->integer('harga')->nullable();
            $table->enum('is_active', ['active', 'eliminasi', 'winner']);
            $table->enum('portfolio', ['show', 'hide']);
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
        Schema::dropIfExists('result_test_contests');
    }
}
