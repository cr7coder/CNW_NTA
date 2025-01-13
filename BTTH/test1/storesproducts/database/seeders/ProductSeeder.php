<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            DB::table('products')->insert([
                'store_id' => $faker->numberBetween(1, 5),
                'name' => $faker->name,
                'description' => $faker->sentence(),
                'price' => $faker->randomFloat,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}