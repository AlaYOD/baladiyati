<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = [
        'service_id',
        'user_id',
        'status',
        'payload',
        'notes',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    public function service(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function citizen(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->user();
    }
}
