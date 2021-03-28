<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrefecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prefectures', function (Blueprint $table) {
            $table->id('prefecture_id')->comment('都道府県ID');
            $table->string('name_ja')->comment('都道府県名：日本語表記');
            $table->string('name_kana')->comment('都道府県名：カタカナ');
            $table->string('name_en')->comment('都道府県名：英語表記');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prefectures');
    }
}
