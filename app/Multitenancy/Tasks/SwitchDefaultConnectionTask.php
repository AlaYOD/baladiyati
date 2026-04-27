<?php

namespace App\Multitenancy\Tasks;

use Illuminate\Support\Facades\DB;
use Spatie\Multitenancy\Concerns\UsesMultitenancyConfig;
use Spatie\Multitenancy\Contracts\IsTenant;
use Spatie\Multitenancy\Tasks\SwitchTenantTask;
use Spatie\Permission\PermissionRegistrar;

class SwitchDefaultConnectionTask implements SwitchTenantTask
{
    use UsesMultitenancyConfig;

    private string $originalDefaultConnection;

    public function __construct()
    {
        $this->originalDefaultConnection = config('database.default');
    }

    public function makeCurrent(IsTenant $tenant): void
    {
        $tenantConnection = $this->tenantDatabaseConnectionName();

        // SwitchTenantDatabaseTask already set the database name in config and
        // called DB::purge(). We now point the default connection at the tenant
        // connection name so connectionless models (Spatie Permission) resolve
        // through the already-configured tenant connection.
        config(['database.default' => $tenantConnection]);
        app('db')->setDefaultConnection($tenantConnection);

        // Purge any stale PDO held by the original default connection so the
        // next query cannot reuse a socket from a different database.
        DB::purge($this->originalDefaultConnection);

        // Flush the in-memory permission cache; it holds model objects resolved
        // against whatever connection was active during the last request.
        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    public function forgetCurrent(): void
    {
        $tenantConnection = $this->tenantDatabaseConnectionName();

        config(['database.default' => $this->originalDefaultConnection]);
        app('db')->setDefaultConnection($this->originalDefaultConnection);

        // Purge the tenant connection so its PDO is released and the next
        // tenant switch always opens a fresh socket to the correct database.
        DB::purge($tenantConnection);

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
