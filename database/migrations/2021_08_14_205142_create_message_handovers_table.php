<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageHandoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_handovers', function (Blueprint $table) {
            $table->integer('result_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('worker_id')->nullable();
            $table->text('feedback_customer')->nullable();
            $table->text('feedback_worker')->nullable();
            $table->string('file')->nullable();
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
        Schema::dropIfExists('message_handovers');
    }
}
