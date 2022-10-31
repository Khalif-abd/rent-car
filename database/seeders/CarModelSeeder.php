<?php

namespace Database\Seeders;


use App\Models\CarModel;
use Illuminate\Database\Seeder;


final class CarModelSeeder extends Seeder
{
    const RECORDS = [
        [
            'brand_id' => 1,
            'name' => 'X7',
        ],
        [
            'brand_id' => 1,
            'name' => 'X6',
        ],
        [
            'brand_id' => 1,
            'name' => 'X5',
        ],
        [
            'brand_id' => 1,
            'name' => 'X4',
        ],
        [
            'brand_id' => 1,
            'name' => 'X3',
        ],
        [
            'brand_id' => 1,
            'name' => 'M8',
        ],
        [
            'brand_id' => 2,
            'name' => 'E 450',
        ],
        [
            'brand_id' => 2,
            'name' => 'E 53 AMG',
        ],
        [
            'brand_id' => 2,
            'name' => 'S 580 4MATIC L',
        ],
        [
            'brand_id' => 2,
            'name' => 'S 350d 4MATIC L',
        ],
        [
            'brand_id' => 3,
            'name' => '718 cayman',
        ],
        [
            'brand_id' => 3,
            'name' => '911 Carrera',
        ],
        [
            'brand_id' => 3,
            'name' => 'Panamera',
        ],
        [
            'brand_id' => 3,
            'name' => 'Panamera 4',
        ],
        [
            'brand_id' => 3,
            'name' => 'Cayenne',
        ],
        [
            'brand_id' => 4,
            'name' => 'S6 TFSI',
        ],
        [
            'brand_id' => 4,
            'name' => 'A3',
        ],
        [
            'brand_id' => 4,
            'name' => 'A4',
        ],
        [
            'brand_id' => 4,
            'name' => 'RS4',
        ],
        [
            'brand_id' => 4,
            'name' => 'A6',
        ],
    ];



    public function run(): void
    {
        foreach (self::RECORDS as $item) {
            CarModel::create([
                'brand_id' => $item['brand_id'],
                'name' => $item['name']
            ]);
        }
    }
}
