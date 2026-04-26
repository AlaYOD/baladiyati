<?php

namespace App\Policies;

use App\Models\User;

/**
 * Authorization policy for tenant User management.
 * Runs exclusively in the municipal panel context — the Gate::before()
 * in AppServiceProvider grants all permissions to 'super-admin' first.
 */
class UserPolicy
{
    /** Any authenticated tenant user may see the user list. */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /** Any authenticated tenant user may view another user's profile. */
    public function view(User $user, User $model): bool
    {
        return true;
    }

    /** Only managers and super-admins may create new users. */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['super-admin', 'manager']);
    }

    /** Only managers and super-admins may update users. */
    public function update(User $user, User $model): bool
    {
        return $user->hasAnyRole(['super-admin', 'manager']);
    }

    /** Only super-admins may delete users. */
    public function delete(User $user, User $model): bool
    {
        return $user->hasRole('super-admin');
    }

    public function restore(User $user, User $model): bool
    {
        return $user->hasRole('super-admin');
    }

    public function forceDelete(User $user, User $model): bool
    {
        return $user->hasRole('super-admin');
    }
}
