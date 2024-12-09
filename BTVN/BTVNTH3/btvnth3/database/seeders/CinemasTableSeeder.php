<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CinemasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('cinemas')->insert([
                'name' => $faker->company . " Cinema",
                'location' => $faker->address,
                'total_seats' => $faker->numberBetween(100, 500),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
