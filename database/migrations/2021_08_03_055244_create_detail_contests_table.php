<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_contests', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->string('title');
            $table->text('description');
            $table->string('title_logo');
            $table->integer('catagories');
            $table->integer('subcatagories');
            $table->integer('package');
            $table->integer('packageupgrade')->nullable();
            $table->integer('harga');
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
        Schema::dropIfExists('detail_contests');
    }
}
