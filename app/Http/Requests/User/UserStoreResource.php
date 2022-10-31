<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreResource extends FormRequest
{


    public function authorize():bool
    {
        return true;
    }


    public function rules():array
    {
        return [
            "email" => ["required", "email", "unique:users,email"],
            "name" => ["required", "string"],
            "password" => ["required", "min:3"],
        ];
    }


    public function messages(): array
    {
        return [
            "email.required" => "Укажите email.",
            "email.email" => "Введите корректный email.",
            "email.unique" => "Такой email адрес уже зарегистрирован.",
            "name.required" => "Укажите имя.",
            "password.required" => "Укажите пароль.",
        ];
    }

}
