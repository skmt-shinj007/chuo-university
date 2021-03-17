<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrefecturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prefectures')->insert([
            [
                'prefecture_id' => 1,
                'name_ja' => '北海道',
                'name_kana' => 'ホッカイドウ',
                'name_en' => 'hokkaido'
            ],
            [
                'prefecture_id' => 2,
                'name_ja' => '青森県',
                'name_kana' => 'アオモリケン',
                'name_en' => 'aomori'
            ],
            [
                'prefecture_id' => 3,
                'name_ja' => '岩手県',
                'name_kana' => 'イワテケン',
                'name_en' => 'iwate'
            ],
            [
                'prefecture_id' => 4,
                'name_ja' => '宮城県',
                'name_kana' => 'ミヤザキケン',
                'name_en' => 'miyagi'
            ],
            [
                'prefecture_id' => 5,
                'name_ja' => '秋田県',
                'name_kana' => 'アキタケン',
                'name_en' => 'akita'
            ],
            [
                'prefecture_id' => 6,
                'name_ja' => '山形県',
                'name_kana' => 'ヤマガタケン',
                'name_en' => 'yamagata'
            ],
            [
                'prefecture_id' => 7,
                'name_ja' => '福島県',
                'name_kana' => 'フクシマケン',
                'name_en' => 'fukushima'
            ],
            [
                'prefecture_id' => 8,
                'name_ja' => '茨城県',
                'name_kana' => 'イバラキケン',
                'name_en' => 'ibagraki'
            ],
            [
                'prefecture_id' => 9,
                'name_ja' => '栃木県',
                'name_kana' => 'トチギケン',
                'name_en' => 'tochigi'
            ],
            [
                'prefecture_id' => 10,
                'name_ja' => '群馬県',
                'name_kana' => 'グンマケン',
                'name_en' => 'gunma'
            ],
            [
                'prefecture_id' => 11,
                'name_ja' => '埼玉県',
                'name_kana' => 'サイタマケン',
                'name_en' => 'saitama'
            ],
            [
                'prefecture_id' => 12,
                'name_ja' => '千葉県',
                'name_kana' => 'チバケン',
                'name_en' => 'chiba'
            ],
            [
                'prefecture_id' => 13,
                'name_ja' => '東京都',
                'name_kana' => 'トウキョウト',
                'name_en' => 'tokyo'
            ],
            [
                'prefecture_id' => 14,
                'name_ja' => '神奈川県',
                'name_kana' => 'カナガワケン',
                'name_en' => 'kanagawa'
            ],
            [
                'prefecture_id' => 15,
                'name_ja' => '新潟県',
                'name_kana' => 'ニイガタケン',
                'name_en' => 'niigata'
            ],
            [
                'prefecture_id' => 16,
                'name_ja' => '富山県',
                'name_kana' => 'トヤマケン',
                'name_en' => 'toyama'
            ],
            [
                'prefecture_id' => 17,
                'name_ja' => '石川県',
                'name_kana' => 'イシカワケン',
                'name_en' => 'ishikawa'
            ],
            [
                'prefecture_id' => 18,
                'name_ja' => '福井県',
                'name_kana' => 'フクイケン',
                'name_en' => 'fukui'
            ],
            [
                'prefecture_id' => 19,
                'name_ja' => '山梨県',
                'name_kana' => 'ヤマナシケン',
                'name_en' => 'yamanashi'
            ],
            [
                'prefecture_id' => 20,
                'name_ja' => '長野県',
                'name_kana' => 'ナガノケン',
                'name_en' => 'nagano'
            ],
            [
                'prefecture_id' => 21,
                'name_ja' => '岐阜県',
                'name_kana' => 'ギフケン',
                'name_en' => 'gifu'
            ],
            [
                'prefecture_id' => 22,
                'name_ja' => '静岡県',
                'name_kana' => 'シズオカケン',
                'name_en' => 'shizuoka'
            ],
            [
                'prefecture_id' => 23,
                'name_ja' => '愛知県',
                'name_kana' => 'アイチケン',
                'name_en' => 'aichi'
            ],
            [
                'prefecture_id' => 24,
                'name_ja' => '三重県',
                'name_kana' => 'ミエケン',
                'name_en' => 'mie'
            ],
            [
                'prefecture_id' => 25,
                'name_ja' => '滋賀県',
                'name_kana' => 'シガケン',
                'name_en' => 'shiga'
            ],
            [
                'prefecture_id' => 26,
                'name_ja' => '京都府',
                'name_kana' => 'キョウトフ',
                'name_en' => 'kyouto'
            ],
            [
                'prefecture_id' => 27,
                'name_ja' => '大阪府',
                'name_kana' => 'オオサカフ',
                'name_en' => 'osaka'
            ],
            [
                'prefecture_id' => 28,
                'name_ja' => '兵庫県',
                'name_kana' => 'ヒョウゴケン',
                'name_en' => 'hyogo'
            ],
            [
                'prefecture_id' => 29,
                'name_ja' => '奈良県',
                'name_kana' => 'ナラケン',
                'name_en' => 'nara'
            ],
            [
                'prefecture_id' => 30,
                'name_ja' => '和歌山県',
                'name_kana' => 'ワカヤマケン',
                'name_en' => 'wakayama'
            ],
            [
                'prefecture_id' => 31,
                'name_ja' => '鳥取県',
                'name_kana' => 'トットリケン',
                'name_en' => 'tottori'
            ],
            [
                'prefecture_id' => 32,
                'name_ja' => '島根県',
                'name_kana' => 'シマネケン',
                'name_en' => 'shimane'
            ],
            [
                'prefecture_id' => 33,
                'name_ja' => '岡山県',
                'name_kana' => 'オカヤマケン',
                'name_en' => 'okayama'
            ],
            [
                'prefecture_id' => 34,
                'name_ja' => '広島県',
                'name_kana' => 'ヒロシマケン',
                'name_en' => 'hiroshima'
            ],
            [
                'prefecture_id' => 35,
                'name_ja' => '山口県',
                'name_kana' => 'ヤマグチケン',
                'name_en' => 'yamaguchi'
            ],
            [
                'prefecture_id' => 36,
                'name_ja' => '徳島県',
                'name_kana' => 'トクシマケン',
                'name_en' => 'tokushima'
            ],
            [
                'prefecture_id' => 37,
                'name_ja' => '香川県',
                'name_kana' => 'カガワケン',
                'name_en' => 'kagawa'
            ],
            [
                'prefecture_id' => 38,
                'name_ja' => '愛媛県',
                'name_kana' => 'エヒメケン',
                'name_en' => 'ehime'
            ],
            [
                'prefecture_id' => 39,
                'name_ja' => '高知県',
                'name_kana' => 'コウチケン',
                'name_en' => 'kouchi'
            ],
            [
                'prefecture_id' => 40,
                'name_ja' => '福岡県',
                'name_kana' => 'フクオカケン',
                'name_en' => 'fukuoka'
            ],
            [
                'prefecture_id' => 41,
                'name_ja' => '佐賀県',
                'name_kana' => 'サガケン',
                'name_en' => 'saga'
            ],
            [
                'prefecture_id' => 42,
                'name_ja' => '長崎県',
                'name_kana' => 'ナガサキケン',
                'name_en' => 'nagasaki'
            ],
            [
                'prefecture_id' => 43,
                'name_ja' => '熊本県',
                'name_kana' => 'クマモトケン',
                'name_en' => 'kumamoto'
            ],
            [
                'prefecture_id' => 44,
                'name_ja' => '大分県',
                'name_kana' => 'オオイタケン',
                'name_en' => 'oita'
            ],
            [
                'prefecture_id' => 45,
                'name_ja' => '宮崎県',
                'name_kana' => 'ミヤザキケン',
                'name_en' => 'miyazaki'
            ],
            [
                'prefecture_id' => 46,
                'name_ja' => '鹿児島県',
                'name_kana' => 'カゴシマケン',
                'name_en' => 'kagoshima'
            ],
            [
                'prefecture_id' => 47,
                'name_ja' => '沖縄県',
                'name_kana' => 'オキナワケン',
                'name_en' => 'okinawa'
            ]
        ]);
    }
}
