<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $fillable = [
        'model_id',
        'number',
    ];

    protected $dates = ['created_at', 'updated_at'];


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_car');
    }


    public function model(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }

}
