<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ItCentersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 10; $i++) { 
            DB::table('it_centers')->insert([
                'name' => 'Trung tâm Tin học ' . $faker->company,
                'location' => $faker->address,
                'contact_email' => $faker->email,
            ]);
        }
    }
}
