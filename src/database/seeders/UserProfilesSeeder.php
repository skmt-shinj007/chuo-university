<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_profiles')->insert([
            [
                'user_id' => 1,
                'first_name_ja' => '悠登',
                'last_name_ja' => '宮崎',
                'first_name_kana' => 'ユウト',
                'last_name_kana' => 'ミヤザキ',
                'first_name_en' => 'yuto',
                'last_name_en' => 'miyazaki',
                'graduation_year' => 2021,
                'grade' => 4,
                'position_id' => 1,
                'prefecture_id' => 6,
                'alma_mater' => '山形県羽黒高等学校',
                'achievement' => '2016 ハイスクールジャパンカップ ダブルス 準優勝',
            ],
            [
                'user_id' => 2,
                'first_name_ja' => '信治',
                'last_name_ja' => '坂本',
                'first_name_kana' => 'シンジ',
                'last_name_kana' => 'サカモト',
                'first_name_en' => 'shinji',
                'last_name_en' => 'sakamoto',
                'graduation_year' => 2021,
                'grade' => 4,
                'position_id' => 2,
                'prefecture_id' => 1,
                'alma_mater' => '北海道科学大学高等学校',
                'achievement' => '2016 全日本高校選抜 3位',
            ],
            [
                'user_id' => 3,
                'first_name_ja' => '雅人',
                'last_name_ja' => '田邉',
                'first_name_kana' => 'マサト',
                'last_name_kana' => 'タナベ',
                'first_name_en' => 'masato',
                'last_name_en' => 'tanabe',
                'graduation_year' => 2021,
                'grade' => 4,
                'position_id' => 2,
                'prefecture_id' => 7,
                'alma_mater' => '三重県三重高等学校',
                'achievement' => '2016 岩手国体 (少年男子) 優勝',
            ],
        ]);
    }
}
