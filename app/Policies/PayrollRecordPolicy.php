<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\PayrollRecord;
use Illuminate\Auth\Access\HandlesAuthorization;

class PayrollRecordPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:PayrollRecord');
    }

    public function view(AuthUser $authUser, PayrollRecord $payrollRecord): bool
    {
        return $authUser->can('View:PayrollRecord');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:PayrollRecord');
    }

    public function update(AuthUser $authUser, PayrollRecord $payrollRecord): bool
    {
        return $authUser->can('Update:PayrollRecord');
    }

    public function delete(AuthUser $authUser, PayrollRecord $payrollRecord): bool
    {
        return $authUser->can('Delete:PayrollRecord');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:PayrollRecord');
    }

    public function restore(AuthUser $authUser, PayrollRecord $payrollRecord): bool
    {
        return $authUser->can('Restore:PayrollRecord');
    }

    public function forceDelete(AuthUser $authUser, PayrollRecord $payrollRecord): bool
    {
        return $authUser->can('ForceDelete:PayrollRecord');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:PayrollRecord');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:PayrollRecord');
    }

    public function replicate(AuthUser $authUser, PayrollRecord $payrollRecord): bool
    {
        return $authUser->can('Replicate:PayrollRecord');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:PayrollRecord');
    }

}