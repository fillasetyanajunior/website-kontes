<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_contests', function (Blueprint $table) {
            $table->id();
            $table->integer('contest_id');
            $table->integer('user_id_worker');
            $table->string('title');
            $table->string('filecontest');
            $table->integer('nilai')->nullable();
            $table->integer('harga')->nullable();
            $table->enum('is_active', ['active', 'eliminasi']);
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
        Schema::dropIfExists('result_contests');
    }
}
