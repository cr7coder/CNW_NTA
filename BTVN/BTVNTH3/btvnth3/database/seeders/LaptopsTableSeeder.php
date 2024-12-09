<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LaptopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $brands = ['Dell', 'HP', 'Apple', 'Lenovo', 'Asus'];
        $models = ['Inspiron 15 3000', 'MacBook Air', 'ThinkPad X1', 'Pavilion', 'VivoBook'];
        $specs = ['i5, 8GB RAM, 256GB SSD', 'i7, 16GB RAM, 512GB SSD', 'i3, 4GB RAM, 128GB SSD'];

        for ($i = 0; $i < 20; $i++) { 
            DB::table('laptops')->insert([
                'brand' => $faker->randomElement($brands),
                'model' => $faker->randomElement($models),
                'specifications' => $faker->randomElement($specs),
                'rental_status' => $faker->boolean(50), 
                'renter_id' => $faker->optional()->numberBetween(1, 10), 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
