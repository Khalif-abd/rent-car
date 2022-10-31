<?php

namespace Tests\Feature;

use App\Models\CarBrand;
use Faker\Factory;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CarBrandTest extends TestCase
{

    public function test_get_cars_brands()
    {
        $response = $this->getJson(route('car-brands.index'));

        $response->assertStatus(200);
    }


    public function test_get_car_brands()
    {
        $carBrand = CarBrand::query()->first();

        $response = $this->getJson(route('car-brands.show', ['car_brand' => $carBrand->id]));

        $response->assertStatus(200);
    }


    public function test_not_found_car_brands()
    {
        $response = $this->getJson(route('car-brands.show', ['car_brand' => 1111111]));

        $response->assertStatus(422)
            ->assertJson(fn(AssertableJson $json) => $json->has('errors'));
    }


    public function test_create_car_brands()
    {

        $faker = Factory::create();
        $faker->unique(false, 10)->city();

        $response = $this->postJson(
            route('car-brands.store'),
            [
                'name' => $faker->unique()->name,
            ]
        );

        $response->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) => $json->has('status')
                ->has('car_brand')
                ->has('message')
            );
    }

    public function test_update_car_brands()
    {
        $carBrand = CarBrand::query()->first();

        $faker = Factory::create();
        $faker->unique(false, 10)->city();

        $response = $this->putJson(
            route('car-brands.update', ['car_brand' => $carBrand->id]),
            ['name' => $faker->unique()->name]
        );


        $response->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) => $json
                ->has('status')
                ->has('car_brand')
                ->has('message')
            );
    }


    public function test_delete_car_brands()
    {
        $carBrand = CarBrand::query()->first();

        $response = $this->deleteJson(
            route('car-brands.destroy', ['car_brand' => $carBrand->id])
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
