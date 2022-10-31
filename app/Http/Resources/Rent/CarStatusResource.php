<?php

namespace App\Http\Resources\Rent;

use Illuminate\Http\Resources\Json\JsonResource;

class CarStatusResource extends JsonResource
{
    public static $wrap = '';

    public function toArray($request): array
    {
        return [
            'status' => true,
            'message' => 'Автомобиль доступен'
        ];
    }
}
