<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class CarModel extends Model
{
    use HasFactory;

    protected $table = 'cars_models';

    protected $fillable = [
        'name',
        'brand_id',
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(CarBrand::class);
    }

}
