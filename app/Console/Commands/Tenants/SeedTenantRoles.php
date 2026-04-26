<?php

namespace App\Console\Commands\Tenants;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

#[Signature('tenants:seed-roles')]
#[Description('Seed default roles into the currently active tenant database.')]
class SeedTenantRoles extends Command
{
    /**
     * Default roles every municipality gets on provisioning.
     * Guard 'web' maps to App\Models\User on the tenant connection.
     *
     * @var array<string>
     */
    private const ROLES = [
        'super-admin',
        'manager',
        'employee',
        'archive-clerk',
    ];

    public function handle(): int
    {
        foreach (self::ROLES as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }

        $this->info('Default roles seeded: '.implode(', ', self::ROLES));

        return self::SUCCESS;
    }
}
