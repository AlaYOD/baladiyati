<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Multitenancy\Models\Tenant;

class TenantUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenant = Tenant::current();
        
        if (! $tenant) {
            $this->command->warn('No tenant context found. Skipping TenantUserSeeder.');
            return;
        }

        // We assume the tenant's domain is the primary domain
        $domain = $tenant->domain; 
        
        $email = 'admin@' . $domain;

        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => $tenant->name . ' Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'department' => 'Administration',
                'job_title' => 'Municipality Administrator',
                'base_salary' => 15000.00,
                'join_date' => now()->startOfYear(),
            ]
        );

        // Assign the super-admin role from Filament Shield
        // Ensure the role exists before assigning
        if (\Spatie\Permission\Models\Role::where('name', 'super_admin')->exists()) {
             $user->assignRole('super_admin');
        } elseif (\Spatie\Permission\Models\Role::where('name', 'super-admin')->exists()) {
             $user->assignRole('super-admin');
        }
    }
}
