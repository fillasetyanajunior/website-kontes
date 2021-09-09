<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_feeds', function (Blueprint $table) {
            $table->integer('contest_id');
            $table->integer('user_id_from');
            $table->integer('user_id_to');
            $table->string('filecontest')->nullable();
            $table->text('description')->nullable();
            $table->integer('rating')->nullable();
            $table->text('feedback')->nullable();
            $table->enum('choices', ['eliminasi', 'feedback','winner choose','rating','comment public','handover','pick winner','handover command','submit']);
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
        Schema::dropIfExists('news_feeds');
    }
}
