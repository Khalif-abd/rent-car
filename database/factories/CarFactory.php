<?php

namespace Database\Factories;


use App\Models\CarModel;
use Illuminate\Database\Eloquent\Factories\Factory;



class CarFactory extends Factory
{

    public function definition(): array
    {
        return [
            'model_id' => CarModel::query()->inRandomOrder()->first()->id,
            'number' => sprintf(
                '%s%03d%s%02d',
                $this->faker->randomElement(['A', 'B', 'E', 'K', 'M', 'H', 'O', 'P', 'T', 'X']),
                $this->faker->numberBetween(1, 999),
                implode('', $this->faker->randomElements(['A', 'B', 'E', 'K', 'M', 'H', 'O', 'P', 'T', 'X'], 2)),
                $this->faker->numberBetween(0, 99),
            )
        ];
    }
}

