<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_date = Carbon::now();

        DB::table('tags')->insert([
            [
                'tag_id' => 1,
                'name_ja' => '部員',
                'name_en' => 'club member',
                'created_at' => $current_date, 
                'updated_at' => $current_date,
                'deleted_at' => null
            ],
            [
                'tag_id' => 2,
                'name_ja' => '主将',
                'name_en' => 'captain',
                'created_at' => $current_date, 
                'updated_at' => $current_date,
                'deleted_at' => null
            ],
            [
                'tag_id' => 3,
                'name_ja' => '主務',
                'name_en' => 'competent',
                'created_at' => $current_date, 
                'updated_at' => $current_date,
                'deleted_at' => null
            ],
            [
                'tag_id' => 4,
                'name_ja' => '副主将',
                'name_en' => 'vice captain',
                'created_at' => $current_date, 
                'updated_at' => $current_date,
                'deleted_at' => null

            ],
            [
                'tag_id' => 5,
                'name_ja' => '会計',
                'name_en' => 'treasurer',
                'created_at' => $current_date, 
                'updated_at' => $current_date,
                'deleted_at' => null
            ],
            [
                'tag_id' => 6,
                'name_ja' => '寮長',
                'name_en' => 'dormitory leader',
                'created_at' => $current_date, 
                'updated_at' => $current_date,
                'deleted_at' => null
            ],
            [
                'tag_id' => 7,
                'name_ja' => 'スタッフ',
                'name_en' => 'staff',
                'created_at' => $current_date, 
                'updated_at' => $current_date,
                'deleted_at' => null
            ],
            [
                'tag_id' => 8,
                'name_ja' => '監督',
                'name_en' => 'head coach',
                'created_at' => $current_date, 
                'updated_at' => $current_date,
                'deleted_at' => null
            ],
            [
                'tag_id' => 9,
                'name_ja' => '部長',
                'name_en' => 'club advisor',
                'created_at' => $current_date, 
                'updated_at' => $current_date,
                'deleted_at' => null
            ],
            [
                'tag_id' => 10,
                'name_ja' => 'コーチ',
                'name_en' => 'coach',
                'created_at' => $current_date, 
                'updated_at' => $current_date,
                'deleted_at' => null
            ],
            [
                'tag_id' => 11,
                'name_ja' => 'マネージャー',
                'name_en' => 'manager',
                'created_at' => $current_date, 
                'updated_at' => $current_date,
                'deleted_at' => null
            ],
            [
                'tag_id' => 12,
                'name_ja' => 'トレーナー',
                'name_en' => 'trainer',
                'created_at' => $current_date, 
                'updated_at' => $current_date,
                'deleted_at' => null
            ],
            [
                'tag_id' => 13,
                'name_ja' => 'OB',
                'name_en' => 'old boy',
                'created_at' => $current_date, 
                'updated_at' => $current_date,
                'deleted_at' => null
            ],
            [
                'tag_id' => 14,
                'name_ja' => '名誉会長',
                'name_en' => 'honorary president',
                'created_at' => $current_date, 
                'updated_at' => $current_date,
                'deleted_at' => null
            ],
            [
                'tag_id' => 15,
                'name_ja' => '参与',
                'name_en' => 'councilor',
                'created_at' => $current_date, 
                'updated_at' => $current_date,
                'deleted_at' => null
            ],
            [
                'tag_id' => 16,
                'name_ja' => '会長',
                'name_en' => 'chairman',
                'created_at' => $current_date, 
                'updated_at' => $current_date,
                'deleted_at' => null
            ],
            [
                'tag_id' => 17,
                'name_ja' => '副会長',
                'name_en' => 'vice chairman',
                'created_at' => $current_date, 
                'updated_at' => $current_date,
                'deleted_at' => null
            ],
            [
                'tag_id' => 18,
                'name_ja' => '理事長',
                'name_en' => 'chief director',
                'created_at' => $current_date, 
                'updated_at' => $current_date,
                'deleted_at' => null
            ],
            [
                'tag_id' => 19,
                'name_ja' => '副理事長',
                'name_en' => 'vice chief director',
                'created_at' => $current_date, 
                'updated_at' => $current_date,
                'deleted_at' => null
            ],
            [
                'tag_id' => 20,
                'name_ja' => '常務理事',
                'name_en' => 'executive director',
                'created_at' => $current_date, 
                'updated_at' => $current_date,
                'deleted_at' => null
            ],
            [
                'tag_id' => 21,
                'name_ja' => '理事',
                'name_en' => 'director',
                'created_at' => $current_date, 
                'updated_at' => $current_date,
                'deleted_at' => null
            ],
            [
                'tag_id' => 22,
                'name_ja' => '監事',
                'name_en' => 'auditor',
                'created_at' => $current_date, 
                'updated_at' => $current_date,
                'deleted_at' => null
            ],
            [
                'tag_id' => 23,
                'name_ja' => '相談役',
                'name_en' => 'counsellor',
                'created_at' => $current_date, 
                'updated_at' => $current_date,
                'deleted_at' => null
            ],
        ]);
    }
}
