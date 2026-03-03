<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use TallCms\Cms\Models\CmsPost;
use Illuminate\Auth\Access\HandlesAuthorization;

class CmsPostPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:CmsPost');
    }

    public function view(AuthUser $authUser, CmsPost $cmsPost): bool
    {
        return $authUser->can('View:CmsPost');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:CmsPost');
    }

    public function update(AuthUser $authUser, CmsPost $cmsPost): bool
    {
        return $authUser->can('Update:CmsPost');
    }

    public function delete(AuthUser $authUser, CmsPost $cmsPost): bool
    {
        return $authUser->can('Delete:CmsPost');
    }

    public function restore(AuthUser $authUser, CmsPost $cmsPost): bool
    {
        return $authUser->can('Restore:CmsPost');
    }

    public function forceDelete(AuthUser $authUser, CmsPost $cmsPost): bool
    {
        return $authUser->can('ForceDelete:CmsPost');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:CmsPost');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:CmsPost');
    }

    public function replicate(AuthUser $authUser, CmsPost $cmsPost): bool
    {
        return $authUser->can('Replicate:CmsPost');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:CmsPost');
    }

}