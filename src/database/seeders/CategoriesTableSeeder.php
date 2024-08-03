<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'テクノロジー',
            'ライフスタイル',
            '健康とフィットネス',
            '旅行',
            '食べ物と飲み物',
            'ファッション',
            'ビジネス',
            '教育',
            'エンターテインメント',
            'ニュース',
            '趣味とクラフト',
            'ペット',
            '家族',
            '自己啓発',
            'スポーツ',
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
