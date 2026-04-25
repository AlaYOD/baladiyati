<?php

namespace App\Models;

use Spatie\Multitenancy\Models\Tenant as SpatieTenant;

class Tenant extends SpatieTenant
{
    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = 'landlord';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'domain',
        'database',
    ];

    /**
     * The "booted" method of the model.
     * We use this to automatically create a database when a tenant is created.
     */
    protected static function booted(): void
    {
        static::created(function (Tenant $tenant) {
            // Optional: Automatically create the PostgreSQL database for the new tenant
            // \Illuminate\Support\Facades\DB::connection('landlord')->statement("CREATE DATABASE \"{$tenant->database}\"");
            
            // Optional: Automatically run migrations for the new tenant
            // \Illuminate\Support\Facades\Artisan::call('tenants:artisan', [
            //     'artisanCommand' => 'migrate --database=tenant',
            //     '--tenant' => $tenant->id,
            // ]);
        });
    }
}
