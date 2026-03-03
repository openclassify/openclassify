<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use TallCms\Cms\Models\TallcmsMenu;
use Illuminate\Auth\Access\HandlesAuthorization;

class TallcmsMenuPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TallcmsMenu');
    }

    public function view(AuthUser $authUser, TallcmsMenu $tallcmsMenu): bool
    {
        return $authUser->can('View:TallcmsMenu');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TallcmsMenu');
    }

    public function update(AuthUser $authUser, TallcmsMenu $tallcmsMenu): bool
    {
        return $authUser->can('Update:TallcmsMenu');
    }

    public function delete(AuthUser $authUser, TallcmsMenu $tallcmsMenu): bool
    {
        return $authUser->can('Delete:TallcmsMenu');
    }

    public function restore(AuthUser $authUser, TallcmsMenu $tallcmsMenu): bool
    {
        return $authUser->can('Restore:TallcmsMenu');
    }

    public function forceDelete(AuthUser $authUser, TallcmsMenu $tallcmsMenu): bool
    {
        return $authUser->can('ForceDelete:TallcmsMenu');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TallcmsMenu');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TallcmsMenu');
    }

    public function replicate(AuthUser $authUser, TallcmsMenu $tallcmsMenu): bool
    {
        return $authUser->can('Replicate:TallcmsMenu');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TallcmsMenu');
    }

}