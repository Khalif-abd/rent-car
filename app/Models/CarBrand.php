<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBrand extends Model
{
    use HasFactory;

    protected $table = 'cars_brands';

    protected $fillable = [
        'name',
    ];

    protected $dates = ['created_at', 'updated_at'];
}
