<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Car\CarBrandRequest;
use App\Http\Resources\Car\CarBrandResource;
use App\Models\CarBrand;
use Illuminate\Database\QueryException;
use Illuminate\Http\Client\HttpClientException;


class CarBrandController extends Controller
{

    /**
     * Вывод списка автомобилей
     */
    public function index()
    {
        return CarBrandResource::collection(CarBrand::all());
    }


    /**
     * Добавление автомобильного бренда
     *
     * @throws HttpClientException
     */
    public function store(CarBrandRequest $request)
    {
        try {
           $carBrand = CarBrand::create($request->all());
        } catch (QueryException $e) {
            throw new HttpClientException('Не удалось добавить бренд.');
        }

        return response([
            'status' => true,
            'car_brand' => $carBrand,
            'message' => "Бренд успешно добавлен.",
        ], 200);
    }


    /**
     * Показ бренда автомобиля
     *
     */
    public function show(CarBrand $carBrand)
    {
        return new CarBrandResource($carBrand);
    }


    /**
     * Обновление бренда автомобиля
     *
     * @throws HttpClientException
     */
    public function update(CarBrandRequest $request, CarBrand $carBrand)
    {
        try {
            $carBrand->update($request->all());
        } catch (QueryException $e) {
            throw new HttpClientException('Не удалось обновить данные.');
        }

        return response([
            'status' => true,
            'car_brand' => $carBrand,
            'message' => "Имя бренда успешно обновлено.",
        ], 200);
    }


    /**
     * Удаление бренда
     *
     * @throws HttpClientException
     */
    public function destroy(CarBrand $carBrand)
    {
        try {
            $carBrand->delete();
        } catch (QueryException $e) {
            throw new HttpClientException('Не удалось удалить бреда.');
        }

        return response([
            'status' => true,
            'message' => "Бренд успешно удален.",
        ], 200);
    }

}
