<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 地域のダミーデータを作成
        $this->call(AreasTableSeeder::class);

        // ジャンルのダミーデータを作成
        $this->call(GenresTableSeeder::class);

        // 店舗情報のダミーデータを作成
        $this->call(ShopSeeder::class);

        // 一般ユーザーのダミーデータを作成
        $this->call(TestUserSeeder::class);

        // システム管理者のダミーデータを作成
        $this->call(SystemManagerSeeder::class);

        // 仙人の店舗代表者のダミーデータを作成
        $this->call(RepresentativeSeeder::class);
    }
}
