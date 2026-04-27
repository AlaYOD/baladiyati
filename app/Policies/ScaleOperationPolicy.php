<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ScaleOperation;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScaleOperationPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ScaleOperation');
    }

    public function view(AuthUser $authUser, ScaleOperation $scaleOperation): bool
    {
        return $authUser->can('View:ScaleOperation');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ScaleOperation');
    }

    public function update(AuthUser $authUser, ScaleOperation $scaleOperation): bool
    {
        return $authUser->can('Update:ScaleOperation');
    }

    public function delete(AuthUser $authUser, ScaleOperation $scaleOperation): bool
    {
        return $authUser->can('Delete:ScaleOperation');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:ScaleOperation');
    }

    public function restore(AuthUser $authUser, ScaleOperation $scaleOperation): bool
    {
        return $authUser->can('Restore:ScaleOperation');
    }

    public function forceDelete(AuthUser $authUser, ScaleOperation $scaleOperation): bool
    {
        return $authUser->can('ForceDelete:ScaleOperation');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ScaleOperation');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ScaleOperation');
    }

    public function replicate(AuthUser $authUser, ScaleOperation $scaleOperation): bool
    {
        return $authUser->can('Replicate:ScaleOperation');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ScaleOperation');
    }

}