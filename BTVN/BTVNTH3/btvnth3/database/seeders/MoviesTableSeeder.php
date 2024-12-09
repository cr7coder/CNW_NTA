<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

     
        $cinemaIds = DB::table('cinemas')->pluck('id')->toArray();

        foreach ($cinemaIds as $cinemaId) {
            for ($i = 1; $i <= 5; $i++) { 
                DB::table('movies')->insert([
                    'title' => $faker->sentence(3),
                    'director' => $faker->name,
                    'release_date' => $faker->date,
                    'duration' => $faker->numberBetween(90, 180),
                    'cinema_id' => $cinemaId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
