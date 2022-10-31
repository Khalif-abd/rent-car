<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Car\CarModelRequest;
use App\Http\Resources\Car\CarModelResource;
use App\Models\CarModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Client\HttpClientException;

class CarModelController extends Controller
{

    /**
     * Вывод списка моделей
     */
    public function index()
    {
        return CarModelResource::collection(CarModel::all());
    }


    /**
     * Добавление модели
     *
     * @throws HttpClientException
     */
    public function store(CarModelRequest $request)
    {
        try {
            $carModel = CarModel::create($request->all());
        } catch (QueryException $e) {
            throw new HttpClientException('Не удалось добавить автомобиль.');
        }

        return response([
            'status' => true,
            'car_model' => $carModel,
            'message' => "Модель автомобиля успешно добавлен.",
        ], 200);
    }


    /**
     * Показ модели
     */
    public function show(CarModel $carModel)
    {
        return new CarModelResource($carModel);
    }


    /**
     * Обновление модели
     *
     * @throws HttpClientException
     */
    public function update(CarModelRequest $request, CarModel $carModel)
    {
        try {
            $carModel->update($request->all());
        } catch (QueryException $e) {
            throw new HttpClientException('Не удалось обновить данные модели.');
        }

        return response([
            'status' => true,
            'car_model' => $carModel,
            'message' => 'Автомобиль успешно сохранен',
        ], 200);
    }


    /**
     * Удаление
     *
     * @throws HttpClientException
     */
    public function destroy(CarModel $carModel)
    {
        try {
            $carModel->delete();
        } catch (QueryException $e) {
            throw new HttpClientException('Не удалось удалить модель.');
        }

        return response([
            'status' => true,
            'message' => "Модель успешно удалена.",
        ], 200);
    }

}
