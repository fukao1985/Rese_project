<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Representative;

class RepresentativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 仙人の店舗代表者のダミーデータをusersテーブルに保存する
        $user = User::create([
            'name' => '仙人 代表者',
            'email' => 'sennin_representative@gmail.com',
            'password' => bcrypt('sennin_representative'),
            'role' => 'representative',
        ]);

        // 店舗代表者のuser_idを使用してrepresentativesテーブルに保存
        Representative::create([
            'user_id' => $user->id,
            'shop_id' => 1,
        ]);
    }
}

