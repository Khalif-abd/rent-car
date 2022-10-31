<?php

namespace App\Http\Resources\Car;

use Illuminate\Http\Resources\Json\JsonResource;

class CarModelResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'brand' => $this->brand->name,
            'model' => $this->name,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s') ?? null,
        ];
    }
}
