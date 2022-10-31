<?php

namespace App\Http\Resources\Rent;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class RentCarResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */

    public static $wrap = '';

    public function toArray($request): array
    {
        return [
            'message' => sprintf('Пользователь %s успешно арендовал автомобиль %s %s с номером %s',
                $this->users->first()->name,
                $this->model->brand->name,
                $this->model->name,
                $this->number,
            ),
        ];
    }
}
