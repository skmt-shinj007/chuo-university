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
            $table->string('first_name_ja')->comment('名字：日本語表記');
            $table->string('last_name_ja')->comment('名前：日本語表記');
            $table->string('first_name_kana')->comment('名字：カタカナ');
            $table->string('last_name_kana')->comment('名前：カタカナ');
            $table->string('first_name_en')->comment('名字：英語表記');
            $table->string('last_name_en')->comment('名前：英語表記');
            $table->year('graduation_year')->nullable()->comment('卒業年');
            $table->unsignedSmallInteger('grade')->nullable()->comment('学年');
            $table->unsignedSmallInteger('position_id')->nullable()->comment('ポジションID');
            $table->unsignedSmallInteger('prefecture_id')->nullable()->comment('都道府県ID');
            $table->text('alma_mater')->nullable()->comment('出身校');
            $table->text('achievement')->nullable()->comment('功績');

            // 外部キー
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
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
