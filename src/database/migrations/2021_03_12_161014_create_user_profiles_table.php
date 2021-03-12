<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id('user_id')->comment('ユーザーID');
            $table->string('first_name_ja')->comment('名字（ja）');
            $table->string('last_name_ja')->comment('名前（ja）');
            $table->string('first_name_kana')->comment('名字（カタカナ）');
            $table->string('last_name_kana')->comment('名前（カタカナ）');
            $table->string('first_name_en')->comment('名字（en）');
            $table->string('last_name_en')->comment('名前（en）');
            $table->
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
        Schema::dropIfExists('user_profiles');
    }
}
