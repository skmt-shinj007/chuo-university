<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            [
                'position_id' => 1,
                'name_ja' => '前衛',
                'name_en' => 'front',
                'color_name' => 'lightgreen',
            ],
            [
                'position_id' => 2,
                'name_ja' => '後衛',
                'name_en' => 'back',
                'color_name' => 'orange',
            ],
        ]);
    }
}
