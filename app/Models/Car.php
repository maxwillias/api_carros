<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'external_id',
        'type',
        'brand',
        'model',
        'version',
        'year_model',
        'year_build',
        'optionals',
        'doors',
        'board',
        'chassi',
        'transmission',
        'km',
        'description',
        'created_at_api',
        'updated_at_api',
        'sold',
        'category',
        'url_car',
        'old_price',
        'price',
        'color',
        'fuel',
        'fotos',
    ];

    protected $casts = [
        'optionals'       => 'array',
        'fotos'           => 'array',
        'sold'            => 'boolean',
        'km'              => 'integer',
        'old_price'       => 'decimal:2',
        'price'           => 'decimal:2',
        'created_at_api'  => 'datetime',
        'updated_at_api'  => 'datetime',
    ];
}
