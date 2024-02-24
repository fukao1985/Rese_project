<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservation;
use Faker\Factory as Faker;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            $shopId = $faker->numberBetween(1, 21);
            if ($shopId >= 3) {
                // shop_id:3が欠番のため3以上の場合は4〜21の乱数を生成
                $shopId = $faker->numberBetween(4, 21);
            }

            $reservation = new Reservation();
            $reservation->user_id = $faker->numberBetween(1, 52);
            $reservation->shop_id = $shopId;
            $reservation->date = $faker->dateTimeBetween('2024-02-25', '2025-02-25')->format('Y-m-d');
            $hour = $faker->numberBetween(17, 21);
            $minute = $faker->randomElement([0, 30]);
            $reservation->time = sprintf('%02d:%02d:00', $hour, $minute);
            $reservation->number = $faker->numberBetween(1, 10);
            $reservation->save();
        }
    }
}
