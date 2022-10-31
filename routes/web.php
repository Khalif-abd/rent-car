<?php


use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('rent');
    Route::get('/cars', 'cars')->name('cars');
    Route::get('/users', 'users')->name('users');
});

