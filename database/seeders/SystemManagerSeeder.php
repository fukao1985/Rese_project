<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\SystemManager;

class SystemManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // システム管理者の情報をusersテーブルに保存する
        $user = User::create([
            'name' => 'システム管理者',
            'email' => 'system_manager@gmail.com',
            'password' => bcrypt('system1manager'),
            'role' => 'system_manager',
        ]);

        // システム管理者のuser_idを使用してsystem_managersテーブルに保存
        SystemManager::create([
            'user_id' => $user->id,
        ]);
    }
}
