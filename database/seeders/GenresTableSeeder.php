<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Genre::insert([
            ['genre' => '寿司'],
            ['genre' => '焼肉'],
            ['genre' => '居酒屋'],
            ['genre' => 'イタリアン'],
            ['genre' => 'ラーメン'],
        ]);
    }
}
