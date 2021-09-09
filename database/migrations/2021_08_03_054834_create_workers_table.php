<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('worker_id', 8);
            $table->string('name');
            $table->string('email');
            $table->string('location')->nullable();
            $table->string('avatar')->nullable();
            $table->text('description')->nullable();
            $table->string('paypal')->nullable();
            $table->enum('status_account', ['unverified', 'verified','suspend']);
            $table->date('suspend')->nullable();
            $table->integer('rating')->nullable();
            $table->integer('rangking')->default(0);
            $table->integer('earning')->default(0);
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
        Schema::dropIfExists('workers');
    }
}
