<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{


    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            "email" => ["required", "sometimes", "email", "unique:users,email"],
            "name" => ["required", "sometimes", "string"],
            "password" => ["required", "sometimes", "min:3"],
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
