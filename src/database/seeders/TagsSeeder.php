<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            [
                'tag_id' => 1,
                'name_ja' => '部員',
                'name_en' => 'club member'
            ],
            [
                'tag_id' => 2,
                'name_ja' => '主将',
                'name_en' => 'captain'
            ],
            [
                'tag_id' => 3,
                'name_ja' => '主務',
                'name_en' => 'competent'
            ],
            [
                'tag_id' => 4,
                'name_ja' => '副主将',
                'name_en' => 'vice captain'
            ],
            [
                'tag_id' => 5,
                'name_ja' => '会計',
                'name_en' => 'treasurer'
            ],
            [
                'tag_id' => 6,
                'name_ja' => '寮長',
                'name_en' => 'dormitory leader'
            ],
            [
                'tag_id' => 7,
                'name_ja' => 'スタッフ',
                'name_en' => 'staff'
            ],
            [
                'tag_id' => 8,
                'name_ja' => '監督',
                'name_en' => 'head coach'
            ],
            [
                'tag_id' => 9,
                'name_ja' => '部長',
                'name_en' => 'club advisor'
            ],
            [
                'tag_id' => 10,
                'name_ja' => 'コーチ',
                'name_en' => 'coach'
            ],
            [
                'tag_id' => 11,
                'name_ja' => 'マネージャー',
                'name_en' => 'manager'
            ],
            [
                'tag_id' => 12,
                'name_ja' => 'トレーナー',
                'name_en' => 'trainer'
            ],
            [
                'tag_id' => 13,
                'name_ja' => 'OB',
                'name_en' => 'old boy'
            ],
            [
                'tag_id' => 14,
                'name_ja' => '名誉会長',
                'name_en' => 'honorary president'
            ],
            [
                'tag_id' => 15,
                'name_ja' => '参与',
                'name_en' => 'councilor'
            ],
            [
                'tag_id' => 16,
                'name_ja' => '会長',
                'name_en' => 'chairman'
            ],
            [
                'tag_id' => 17,
                'name_ja' => '副会長',
                'name_en' => 'vice chairman'
            ],
            [
                'tag_id' => 18,
                'name_ja' => '理事長',
                'name_en' => 'chief director'
            ],
            [
                'tag_id' => 19,
                'name_ja' => '副理事長',
                'name_en' => 'vice chief director'
            ],
            [
                'tag_id' => 20,
                'name_ja' => '常務理事',
                'name_en' => 'executive director'
            ],
            [
                'tag_id' => 21,
                'name_ja' => '理事',
                'name_en' => 'director'
            ],
            [
                'tag_id' => 22,
                'name_ja' => '監事',
                'name_en' => 'auditor'
            ],
            [
                'tag_id' => 23,
                'name_ja' => '相談役',
                'name_en' => 'counsellor'
            ],
        ]);
    }
}
