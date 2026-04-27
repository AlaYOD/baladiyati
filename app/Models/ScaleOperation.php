<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScaleOperation extends Model
{
    protected $fillable = [
        'vehicle_plate',
        'driver_name',
        'material_type',
        'gross_weight',
        'tare_weight',
        'fee',
        'status',
        'is_live',
    ];

    protected $casts = [
        'gross_weight' => 'decimal:2',
        'tare_weight' => 'decimal:2',
        'net_weight' => 'decimal:2',
        'fee' => 'decimal:2',
        'is_live' => 'boolean',
    ];
}
