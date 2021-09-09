<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('id_project');
            $table->string('title');
            $table->enum('catagories_project',['contest','direct']);
            $table->string('catagories');
            $table->enum('is_active', ['waitting payment', 'running', 'choose winner', 'handover', 'close', 'cancel', 'mediation']);
            $table->integer('harga');
            $table->text('shouldhave')->nullable();
            $table->text('shouldnothave')->nullable();
            $table->date('deadline')->nullable();
            $table->integer('nilai')->nullable();
            $table->date('submit')->nullable();
            $table->enum('guarded', ['active', 'not active'])->default('not active');
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
        Schema::dropIfExists('projects');
    }
}
