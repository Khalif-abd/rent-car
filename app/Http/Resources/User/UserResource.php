<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;


class UserResource extends JsonResource
{

    public static $wrap = 'user';

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'status' => (bool)$this->cars()->count()
        ];
    }
}
