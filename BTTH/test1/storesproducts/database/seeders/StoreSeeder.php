<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 5) as $index) {
            DB::table('stores')->insert([
                'name' => $faker->company, // Sửa tên cửa hàng thành công ty
                'address' => $faker->address,
                'phone' => $faker->phoneNumber, // Sử dụng phoneNumber mà không cần unique()
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
