<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\Rent\CompleteLeaseCarResource;
use App\Http\Resources\Rent\RentCarResource;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Response;

class RentCarController extends Controller
{


    /**
     * Регистрация аренды автомобиля пользователем
     *
     * @throws HttpClientException
     */
    public function rentCar(User $user, Car $car): RentCarResource|Response
    {
        if ($user->cars()->count()) {
            throw new HttpClientException('Водитель занят.');
        }

        if ($car->users()->count()) {
            throw new HttpClientException('Автомобиль уже арендуется другим водителем.');
        }


        $car->users()->attach($user);

        return new RentCarResource($car);
    }


    /**
     * Получение статуса автомобиля и пользователя
     *
     * @throws HttpClientException
     */
    public function getRentStatus(User $user, Car $car): RentCarResource|Response
    {
        if ($user->cars()->count()) {
            throw new HttpClientException('Водитель занят.');
        }

        if ($car->users()->count()) {
            throw new HttpClientException('Автомобиль уже арендуется другим водителем.');
        }

        return response(['status' => true], 200);
    }


    /**
     * Завершение аренды автомобиля
     *
     * @throws HttpClientException
     */
    public function completeLeaseCar(User $user, Car $car): CompleteLeaseCarResource|Response
    {
        if (!$car->users()->count()) {
            throw new HttpClientException('Данный автомобиль не арендуется.');
        }

        $user = $car->users()->first();

        $car->users()->detach($user);

        return new CompleteLeaseCarResource(['user' => $user, 'car' => $car]);
    }


}
