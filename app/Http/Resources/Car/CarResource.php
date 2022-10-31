<?php

namespace App\Http\Resources\Car;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{

    public function toArray($request): array
    {

        return [
            'id' => $this->id,
            'name' => $this->model->brand->name,
            'model' => $this->model->name,
            'number' => $this->number,
            'status' => (bool)$this->users()->count(),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s') ?? null,
        ];
    }
}
