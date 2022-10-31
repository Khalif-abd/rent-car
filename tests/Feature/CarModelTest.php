<?php

namespace Tests\Feature;

use App\Models\CarBrand;
use App\Models\CarModel;
use Faker\Factory;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CarModelTest extends TestCase
{

    public function test_get_cars_models()
    {
        $response = $this->getJson(route('car-models.index'));

        $response->assertStatus(200);
    }


    public function test_get_car_model()
    {
        $carModel = CarModel::query()->first();

        $response = $this->getJson(route('car-models.show', ['car_model' => $carModel->id]));

        $response->assertStatus(200);
    }


    public function test_not_found_car_model()
    {
        $response = $this->getJson(route('car-models.show', ['car_model' => 1111111]));

        $response->assertStatus(422)
            ->assertJson(fn(AssertableJson $json) => $json->has('errors'));
    }


    public function test_create_car_model()
    {
        $faker = Factory::create();

        $carBrand = CarBrand::query()->first();

        $response = $this->postJson(
            route('car-models.store'),
            [
                'brand_id' => $carBrand->id,
                'name' => $faker->unique()->name,
            ]
        );

        $response->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) => $json->has('status')
                ->has('car_model')
                ->has('message')
            );
    }


    public function test_update_car_model()
    {

        $carModel = CarModel::query()->first();
        $carBrand = CarBrand::query()->first();

        $faker = Factory::create();
        $faker->unique()->email;

        $response = $this->putJson(
            route('car-models.update', ['car_model' => $carModel->id]),
            ['name' => 'X7', 'brand_id' => $carBrand->id]
        );


        $response->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) => $json
                ->has('status')
                ->has('car_model')
                ->has('message')
            );
    }


    public function test_delete_car_model()
    {
        $carModel = CarModel::query()->first();

        $response = $this->deleteJson(
            route('car-models.destroy', ['car_model' => $carModel->id])
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
