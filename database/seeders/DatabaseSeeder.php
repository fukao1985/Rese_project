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
        // usersテーブルのダミーデータ作成
        \App\Models\User::factory(50)->create();

        // システム管理者のダミーデータを作成
        $this->call(SystemManagerSeeder::class);

    }
}
