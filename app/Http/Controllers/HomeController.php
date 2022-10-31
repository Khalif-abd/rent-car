<?php

namespace App\Http\Controllers;


use App\Models\Car;
use App\Models\User;
use Illuminate\Contracts\View\View;


class HomeController extends Controller
{

    public function index(): View
    {
        $users = User::all();
        $cars = Car::all();

        return view('rent', ['users' => $users, 'cars' => $cars]);
    }


    public function cars(): View
    {
        $cars = Car::all();

        return view('cars', ['cars' => $cars]);
    }

    public function users(): View
    {
        $users = User::all();

        return view('users', ['users' => $users]);
    }


}
