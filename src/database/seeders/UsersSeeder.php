<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_date = Carbon::now();

        DB::table('users')->insert([
            [
                'user_id' => 1,
                'created_at' => $current_date,
            ],
            [
                'user_id' => 2,
                'created_at' => $current_date,
            ],
            [
                'user_id' => 3,
                'created_at' => $current_date,
            ],
        ]);
    }
}
