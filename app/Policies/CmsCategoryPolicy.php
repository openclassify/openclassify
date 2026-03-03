<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use TallCms\Cms\Models\CmsCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class CmsCategoryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:CmsCategory');
    }

    public function view(AuthUser $authUser, CmsCategory $cmsCategory): bool
    {
        return $authUser->can('View:CmsCategory');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:CmsCategory');
    }

    public function update(AuthUser $authUser, CmsCategory $cmsCategory): bool
    {
        return $authUser->can('Update:CmsCategory');
    }

    public function delete(AuthUser $authUser, CmsCategory $cmsCategory): bool
    {
        return $authUser->can('Delete:CmsCategory');
    }

    public function restore(AuthUser $authUser, CmsCategory $cmsCategory): bool
    {
        return $authUser->can('Restore:CmsCategory');
    }

    public function forceDelete(AuthUser $authUser, CmsCategory $cmsCategory): bool
    {
        return $authUser->can('ForceDelete:CmsCategory');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:CmsCategory');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:CmsCategory');
    }

    public function replicate(AuthUser $authUser, CmsCategory $cmsCategory): bool
    {
        return $authUser->can('Replicate:CmsCategory');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:CmsCategory');
    }

}