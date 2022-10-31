<?php

namespace App\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;


class CarStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'model_id' => ['required', 'exists:App\Models\CarModel,id'],
            'number' => ['required', 'string', 'unique:cars,number'],
        ];
    }


    public function messages(): array
    {
        return [
            'model_id.required' => 'Укажите id модели.',
            'model_id.exists' => 'Модель автомобиля не найдена.',
            'number.required' => 'Укажите гос.номер автомобиля.',
            'number.unique' => 'Автомобиль с таким номером уже зарегистрирован.',
            'number.string' => 'Не валидный номер автомобиля.',
        ];
    }

}
