<?php

namespace Tests\Feature;

use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;


class UserTest extends TestCase
{


    public function test_get_users()
    {
        $response = $this->getJson(route('users.index'));

        $response->assertStatus(200);
    }


    public function test_get_user()
    {
        $user = User::query()->first();

        $response = $this->getJson(route('users.show', ['user' => $user->id]));

        $response->assertStatus(200);
    }


    public function test_not_found_user()
    {
        $response = $this->getJson(route('users.show', ['user' => 1111111]));

        $response->assertStatus(422)
            ->assertJson(fn(AssertableJson $json) => $json->has('errors')
            );
    }


    public function test_create_user()
    {
        $faker = Factory::create();
        $faker->unique()->email;

        $response = $this->postJson(
            route('users.store'),
            [
                'email' => $faker->unique()->email,
                'name' => $faker->unique()->name,
                'password' => $faker->unique()->password
            ]
        );

        $response->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) => $json->has('status')
                ->has('user')
                ->has('message')
            );
    }


    public function test_update_user()
    {
        $user = User::query()->first();

        $faker = Factory::create();
        $faker->unique()->email;


        $response = $this->putJson(
            route('users.update', ['user' => $user->id]),
            ['email' => $faker->unique()->email, 'name' => 'feature test', 'password' => '12345']
        );


        $response->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) => $json->has('status')
                ->has('user')
                ->has('message')
            );
    }


    public function test_delete_user()
    {
        $user = User::query()->first();

        $response = $this->deleteJson(
            route('users.destroy', ['user' => $user->id])
        );


        $response->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) => $json->has('status')
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
