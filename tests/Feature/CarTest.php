<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\CarModel;
use Faker\Factory;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CarTest extends TestCase
{


    public function test_get_cars()
    {
        $response = $this->getJson(route('cars.index'));

        $response->assertStatus(200);
    }


    public function test_get_car()
    {
        $car = Car::query()->first();

        $response = $this->getJson(route('cars.show', ['car' => $car->id]));

        $response->assertStatus(200);
    }


    public function test_not_found_car()
    {
        $response = $this->getJson(route('users.show', ['user' => 1111111]));

        $response->assertStatus(422)
            ->assertJson(fn(AssertableJson $json) => $json->has('errors'));
    }


    public function test_create_car()
    {
        $faker = Factory::create();

        $model = CarModel::query()->first();

        $response = $this->postJson(
            route('cars.store'),
            [
                'model_id' => $model->id,
                'number' => $faker->unique()->phoneNumber,
            ]
        );

        $response->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) => $json->has('status')
                ->has('car')
                ->has('message')
            );
    }


    public function test_update_car()
    {
        $car = Car::query()->first();
        $model = CarModel::query()->first();

        $faker = Factory::create();
        $faker->unique()->email;

        $response = $this->putJson(
            route('cars.update', ['car' => $car->id]),
            ['model_id' => $model->id, 'number' => 'M001M01']
        );


        $response->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) => $json
                ->has('status')
                ->has('car')
                ->has('message')
            );
    }


    public function test_delete_car()
    {
        $car = Car::query()->first();

        $response = $this->deleteJson(
            route('cars.destroy', ['car' => $car->id])
        );


        $response->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) => $json
                ->has('status')
                ->has('message')
            );
    }

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('optimize:clear');
        Artisan::call('migrate:fresh --seed');
    }

}
