<?php

namespace Database\Seeders;


use App\Models\CarBrand;
use Illuminate\Database\Seeder;


final class CarBrandSeeder extends Seeder
{

    const RECORDS = [
        'BMW',
        'Mercedes',
        'Porsche',
        'Audi'
    ];


    public function run(): void
    {
        foreach (self::RECORDS as $item) {
            CarBrand::create([
                'name' => $item
            ]);
        }
    }
}
