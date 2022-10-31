<?php

namespace App\Http\Resources\Rent;


use Illuminate\Http\Resources\Json\JsonResource;


class CompleteLeaseCarResource extends JsonResource
{

    public static $wrap = '';

    public function toArray($request): array
    {
        return [
            'message' => sprintf(
                'Пользователь %s перестал арендовать автомобиль %s %s',
                $this['user']->name,
                $this['car']->model->brand->name,
                $this['car']->model->name,
            ),
        ];
    }
}
