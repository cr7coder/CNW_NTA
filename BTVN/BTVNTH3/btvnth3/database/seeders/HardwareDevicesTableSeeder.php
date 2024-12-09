<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class HardwareDevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 50; $i++) { 
            DB::table('hardware_devices')->insert([
                'device_name' => $faker->word . ' ' . $faker->randomElement(['Mouse', 'Keyboard', 'Headset']),
                'type' => $faker->randomElement(['Mouse', 'Keyboard', 'Headset']),
                'status' => $faker->boolean,
                'center_id' => $faker->numberBetween(1, 10), 
            ]);
        }
    }
}
