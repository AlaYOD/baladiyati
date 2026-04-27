<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceTemplate extends Model
{
    protected $fillable = [
        'name',
        'form_schema',
    ];

    protected $casts = [
        'form_schema' => 'array',
    ];

    public function serviceRequests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class);
    }
}
