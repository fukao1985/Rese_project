<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 一般ユーザーのダミーデータをusersテーブルに保存する
        $user = User::create([
            'name' => 'テスト 花子',
            'email' => 'testhanako@gmail.com',
            'password' => bcrypt('testhanako'),
            'role' => null,
        ]);
    }
}
