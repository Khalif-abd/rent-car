<?php

namespace Database\Seeders;


use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(CarBrandSeeder::class);
        $this->call(CarModelSeeder::class);
        User::factory()->count(10)->create();
        Car::factory()->count(30)->create();
    }
}
