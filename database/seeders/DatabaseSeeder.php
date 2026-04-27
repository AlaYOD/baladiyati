<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seeds run against the landlord database.
     * Tenant-specific seeders are invoked from TenantObserver during provisioning.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);
    }
}
