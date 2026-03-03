<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use TallCms\Cms\Models\TallcmsMedia;
use Illuminate\Auth\Access\HandlesAuthorization;

class TallcmsMediaPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TallcmsMedia');
    }

    public function view(AuthUser $authUser, TallcmsMedia $tallcmsMedia): bool
    {
        return $authUser->can('View:TallcmsMedia');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TallcmsMedia');
    }

    public function update(AuthUser $authUser, TallcmsMedia $tallcmsMedia): bool
    {
        return $authUser->can('Update:TallcmsMedia');
    }

    public function delete(AuthUser $authUser, TallcmsMedia $tallcmsMedia): bool
    {
        return $authUser->can('Delete:TallcmsMedia');
    }

    public function restore(AuthUser $authUser, TallcmsMedia $tallcmsMedia): bool
    {
        return $authUser->can('Restore:TallcmsMedia');
    }

    public function forceDelete(AuthUser $authUser, TallcmsMedia $tallcmsMedia): bool
    {
        return $authUser->can('ForceDelete:TallcmsMedia');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TallcmsMedia');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TallcmsMedia');
    }

    public function replicate(AuthUser $authUser, TallcmsMedia $tallcmsMedia): bool
    {
        return $authUser->can('Replicate:TallcmsMedia');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TallcmsMedia');
    }

}