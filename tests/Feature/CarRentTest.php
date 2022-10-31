<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CarRentTest extends TestCase
{

    public function test_rent_and_complete_lease_car(): void
    {
        $user = User::query()->first();
        $car = Car::query()->first();

        $response = $this->getJson(route('rent-car', ['user' => $user->id, 'car' => $car->id]));

        $response->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) => $json
                ->has('message')
            );


        $response = $this->getJson(route('complete-lease-car', ['car' => $car->id]));

        $response->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) => $json
                ->has('message')
            );
    }



    public function test_rent_car_if_user_busy_or_car_busy(): void
    {
        $user = User::query()->first();
        $car = Car::query()->first();

        $this->getJson(route('rent-car', ['user' => $user->id, 'car' => $car->id]));

        $response = $this->getJson(route('rent-car', ['user' => $user->id, 'car' => $car->id]));

        $response->assertStatus(422)
            ->assertJson(fn(AssertableJson $json) => $json->has('errors'));


        $this->getJson(route('get-rent-status', ['user' => $user->id, 'car' => $car->id]));

        $response = $this->getJson(route('rent-car', ['user' => $user->id, 'car' => $car->id]));

        $response->assertStatus(422)
            ->assertJson(fn(AssertableJson $json) => $json->has('errors'));

    }

    public function test_rent_non_exiting_user()
    {
        $car = Car::query()->first();

        $response = $this->getJson(route('rent-car', ['user' => 123123123, 'car' => $car->id]));

        $response->assertStatus(422)
            ->assertJson(fn(AssertableJson $json) => $json->has('errors'));
    }


    public function test_rent_non_exiting_car()
    {
        $user = User::query()->first();

        $response = $this->getJson(route('rent-car', ['user' => $user->id, 'car' => 1231231231231]));

        $response->assertStatus(422)
            ->assertJson(fn(AssertableJson $json) => $json->has('errors'));
    }


    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('optimize:clear');
        Artisan::call('migrate:fresh --seed');
    }
}
