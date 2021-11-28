<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemesDesainCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes_desain_cards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('thumnail');
            $table->text('themes');
            $table->enum('choices', ['businesscard', 'emailsignature','letterheads','flayer','invoices','postcard','facebookcover','facebookpost','youtubebenners','instagrampost']);
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
        Schema::dropIfExists('themes_desain_cards');
    }
}
