<?php

namespace App\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;

class CarModelRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required'],
            'brand_id' => ['sometimes', 'required', 'exists:App\Models\CarBrand,id'],
        ];
    }


    public function messages(): array
    {
        return [];
    }
}
