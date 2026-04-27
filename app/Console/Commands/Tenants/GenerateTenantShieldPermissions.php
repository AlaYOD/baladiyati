<?php

namespace App\Console\Commands\Tenants;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Spatie\Multitenancy\Commands\Concerns\TenantAware;
use Spatie\Multitenancy\Contracts\IsTenant;

#[Signature('tenants:generate-shield-permissions {--tenant=* : Tenant id(s) to target; omit for all tenants}')]
#[Description('Run outstanding tenant migrations then generate Shield permissions for the municipal panel.')]
class GenerateTenantShieldPermissions extends Command
{
    use TenantAware;

    public function handle(): int
    {
        /** @var IsTenant $tenant */
        $tenant = app(IsTenant::class)::current();

        $database = $tenant->getDatabaseName();

        $exists = DB::connection('landlord')
            ->table('pg_database')
            ->where('datname', $database)
            ->where('datistemplate', false)
            ->exists();

        if (! $exists) {
            $this->components->warn("Skipping [{$tenant->name}]: database [{$database}] does not exist.");

            return self::FAILURE;
        }

        $this->components->info("Processing tenant [{$tenant->name}] on [{$database}]...");

        Artisan::call('migrate', [
            '--database' => 'tenant',
            '--path' => 'database/migrations/tenant',
            '--force' => true,
        ], $this->output);

        Artisan::call('tenants:seed-roles', [], $this->output);

        Artisan::call('shield:generate', [
            '--panel' => 'municipal',
            '--all' => true,
            '--option' => 'policies_and_permissions',
        ], $this->output);

        return self::SUCCESS;
    }
}
