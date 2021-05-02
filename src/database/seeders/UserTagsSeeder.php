<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_date = Carbon::now();
        
        DB::table('user_tags')->insert([
            [ 'user_id' => 1, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 2, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 3, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 4, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 5, 'tag_id' => 1, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 5, 'tag_id' => 2, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 6, 'tag_id' => 1, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 6, 'tag_id' => 3, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 7, 'tag_id' => 1, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 8, 'tag_id' => 1, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 9, 'tag_id' => 1, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 10, 'tag_id' => 1, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 11, 'tag_id' => 1, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 12, 'tag_id' => 1, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 13, 'tag_id' => 1, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 14, 'tag_id' => 1, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 15, 'tag_id' => 1, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 15, 'tag_id' => 6, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 16, 'tag_id' => 1, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 16, 'tag_id' => 5, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 17, 'tag_id' => 1, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 18, 'tag_id' => 1, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 19, 'tag_id' => 1, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 20, 'tag_id' => 1, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 21, 'tag_id' => 1, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 22, 'tag_id' => 1, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 23, 'tag_id' => 7, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 23, 'tag_id' => 8, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 23, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 23, 'tag_id' => 21, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 24, 'tag_id' => 7, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 24, 'tag_id' => 9, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 25, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 25, 'tag_id' => 14, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 26, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 26, 'tag_id' => 15, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 27, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 27, 'tag_id' => 15, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 28, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 28, 'tag_id' => 23, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 29, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 29, 'tag_id' => 16, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 30, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 30, 'tag_id' => 15, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 31, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 31, 'tag_id' => 17, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 32, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 32, 'tag_id' => 17, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 33, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 33, 'tag_id' => 17, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 34, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 34, 'tag_id' => 18, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 35, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 35, 'tag_id' => 19, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 36, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 36, 'tag_id' => 20, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 37, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 38, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 39, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 39, 'tag_id' => 21, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 40, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 40, 'tag_id' => 22, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 41, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 41, 'tag_id' => 21, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 42, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 42, 'tag_id' => 21, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 43, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 43, 'tag_id' => 21, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 44, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 44, 'tag_id' => 21, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 45, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 45, 'tag_id' => 21, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 45, 'tag_id' => 7, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 45, 'tag_id' => 10, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 46, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 46, 'tag_id' => 21, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 47, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 47, 'tag_id' => 21, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 48, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 48, 'tag_id' => 22, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 49, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 50, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 50, 'tag_id' => 8, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 50, 'tag_id' => 21, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 51, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 52, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 53, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 53, 'tag_id' => 21, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 54, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 54, 'tag_id' => 21, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 55, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 55, 'tag_id' => 21, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 56, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 56, 'tag_id' => 21, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 57, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 57, 'tag_id' => 21, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 58, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 58, 'tag_id' => 21, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 59, 'tag_id' => 13, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ],
            [ 'user_id' => 59, 'tag_id' => 21, 'created_at' => $current_date, 'updated_at' => $current_date, 'deleted_at' => null ]
        ]);
    }
}
