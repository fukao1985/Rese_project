<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Area::insert([
            ['area' => '東京都'],
            ['area' => '大阪府'],
            ['area' => '福岡県'],
        ]);
    }
}
