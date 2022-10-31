<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Car\CarRequest;
use App\Http\Requests\Car\CarStoreRequest;
use App\Http\Resources\Car\CarResource;
use App\Models\Car;
use Illuminate\Database\QueryException;
use Illuminate\Http\Client\HttpClientException;

class CarController extends Controller
{

    /**
     * Вывод списка автомобилей
     */
    public function index()
    {
        return CarResource::collection(Car::all());
    }


    /**
     * Добавление автомобиля
     *
     * @throws HttpClientException
     */
    public function store(CarStoreRequest $request)
    {
        try {
            $car = Car::create($request->all());
        } catch (QueryException $e) {
            throw new HttpClientException('Не удалось добавить автомобиль.');
        }

        return response([
            'status' => true,
            'car' => $car,
            'message' => "Автомобиль успешно добавлен",
        ], 200);
    }


    /**
     * Показ автомобиля
     *
     */
    public function show(Car $car)
    {
        return new CarResource($car);
    }


    /**
     * Обновление автомобиля
     *
     * @throws HttpClientException
     */
    public function update(CarRequest $request, Car $car)
    {
        try {
            $car->update($request->all());
        } catch (QueryException $e) {
            throw new HttpClientException('Не удалось обновить данные автомобиля.');
        }

        return response([
            'status' => true,
            'car' => $car,
            'message' => 'Автомобиль успешно сохранен.',
        ], 200);
    }


    /**
     * Удаление
     *
     * @throws HttpClientException
     */
    public function destroy(Car $car)
    {
        try {
            $car->delete();
        } catch (QueryException $e) {
            throw new HttpClientException('Не удалось удалить автомобиль.');
        }

        return response([
            'status' => true,
            'message' => "Автомобиль успешно удален.",
        ], 200);
    }

}
