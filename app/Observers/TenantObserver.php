<?php

namespace App\Observers;

use App\Models\Tenant;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TenantObserver
{
    /**
     * Provisions a fresh PostgreSQL database and runs tenant migrations
     * immediately after a Tenant record is persisted in the landlord DB.
     */
    public function created(Tenant $tenant): void
    {
        $databaseName = $this->resolveDatabaseName($tenant);

        $this->createDatabase($databaseName);

        $tenant->withoutEvents(function () use ($tenant, $databaseName) {
            $tenant->update(['database' => $databaseName]);
        });

        $tenant->refresh();

        $tenant->makeCurrent();

        try {
            Artisan::call('migrate', [
                '--database' => 'tenant',
                '--path' => 'database/migrations/tenant',
                '--force' => true,
            ]);

            Artisan::call('tenants:seed-roles');

            Artisan::call('shield:generate', [
                '--panel' => 'municipal',
                '--all' => true,
                '--option' => 'policies_and_permissions',
            ]);
        } finally {
            Tenant::forgetCurrent();
        }
    }

    /**
     * Builds a deterministic, Postgres-safe database name from the tenant record.
     *
     * Format: tenant_{id}_{slug}  e.g. tenant_3_ramallah
     * Max 63 chars (Postgres identifier limit).
     */
    private function resolveDatabaseName(Tenant $tenant): string
    {
        $slug = Str::slug($tenant->name, '_');

        $name = "tenant_{$tenant->id}_{$slug}";

        return substr($name, 0, 63);
    }

    /**
     * Issues a raw CREATE DATABASE statement against the landlord connection.
     *
     * Must use the landlord connection because tenant connection points to
     * TENANT_DB_DATABASE which may not exist yet.
     */
    private function createDatabase(string $databaseName): void
    {
        // PostgreSQL does not support CREATE DATABASE inside a transaction,
        // so we use statement() on an autocommit connection.
        DB::connection('landlord')->statement(
            "CREATE DATABASE \"{$databaseName}\""
        );
    }
}
