<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use TallCms\Cms\Models\CmsPage;
use Illuminate\Auth\Access\HandlesAuthorization;

class CmsPagePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:CmsPage');
    }

    public function view(AuthUser $authUser, CmsPage $cmsPage): bool
    {
        return $authUser->can('View:CmsPage');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:CmsPage');
    }

    public function update(AuthUser $authUser, CmsPage $cmsPage): bool
    {
        return $authUser->can('Update:CmsPage');
    }

    public function delete(AuthUser $authUser, CmsPage $cmsPage): bool
    {
        return $authUser->can('Delete:CmsPage');
    }

    public function restore(AuthUser $authUser, CmsPage $cmsPage): bool
    {
        return $authUser->can('Restore:CmsPage');
    }

    public function forceDelete(AuthUser $authUser, CmsPage $cmsPage): bool
    {
        return $authUser->can('ForceDelete:CmsPage');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:CmsPage');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:CmsPage');
    }

    public function replicate(AuthUser $authUser, CmsPage $cmsPage): bool
    {
        return $authUser->can('Replicate:CmsPage');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:CmsPage');
    }

}