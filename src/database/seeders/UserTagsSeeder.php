<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_tags')->insert([
            [
                'user_id' => 1,
                'tag_id' => 13,
            ],
            [
                'user_id' => 2,
                'tag_id' => 13,
            ],
            [
                'user_id' => 3,
                'tag_id' => 13,
            ]
        ]);
    }
}
