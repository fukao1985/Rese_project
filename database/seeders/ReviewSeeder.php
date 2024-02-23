<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;
use Faker\Factory as Faker;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            $shopId = $faker->numberBetween(1, 2);
            if ($shopId == 3) {
                // shop_id:3が欠番のため3の場合は4〜21の乱数を生成
                $shopId = $faker->numberBetween(4, 21); // 3の場合は4〜21の乱数を生成
            }

            $review = new Review();
            $review->user_id = $faker->numberBetween(1, 52);
            $review->shop_id = $shopId;
            $review->user_name = $faker->name();
            $review->ranting = $faker->numberBetween(1, 5);
            $review->comment = $faker->text();
            $review->save();
        }
    }
}
