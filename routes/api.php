<?php

use App\Http\Controllers\Api\CarBrandController;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\CarModelController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RentCarController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::controller(RentCarController::class)->group(function () {
    Route::get('rent-car/{user}/{car}', 'rentCar')->name('rent-car');
    Route::get('get-rent-status/{user}/{car}', 'getRentStatus')->name('get-rent-status');
    Route::get('complete-lese-car/{car}', 'completeLeaseCar')->name('complete-lease-car');
});


Route::apiResources([
    'users' => UserController::class,
    'cars' =>  CarController::class,
    'car-brands' =>  CarBrandController::class,
    'car-models' =>  CarModelController::class,
]);


