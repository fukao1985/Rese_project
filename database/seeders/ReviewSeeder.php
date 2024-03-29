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
        $faker = Faker::create('ja_JP');

        for ($i = 0; $i < 200; $i++) {
            $review = new Review();
            $review->user_id = $faker->numberBetween(1, 53);
            $review->shop_id = $faker->numberBetween(1, 20);
            $review->user_name = $faker->name();
            $review->ranting = $faker->numberBetween(1, 5);
            $review->comment = $faker->realText();
            $review->save();
        }
    }
}
