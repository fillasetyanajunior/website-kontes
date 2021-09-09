<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('id_project');
            $table->string('payment_id_transaksi');
            $table->integer('project_id');
            $table->string('invoicepayment');
            $table->string('name_transaksi');
            $table->string('email_transaksi');
            $table->string('name');
            $table->string('email');
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
        Schema::dropIfExists('project_payments');
    }
}
