<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use TallCms\Cms\Models\CmsComment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CmsCommentPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:CmsComment');
    }

    public function view(AuthUser $authUser, CmsComment $cmsComment): bool
    {
        return $authUser->can('View:CmsComment');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:CmsComment');
    }

    public function update(AuthUser $authUser, CmsComment $cmsComment): bool
    {
        return $authUser->can('Update:CmsComment');
    }

    public function delete(AuthUser $authUser, CmsComment $cmsComment): bool
    {
        return $authUser->can('Delete:CmsComment');
    }

    public function restore(AuthUser $authUser, CmsComment $cmsComment): bool
    {
        return $authUser->can('Restore:CmsComment');
    }

    public function forceDelete(AuthUser $authUser, CmsComment $cmsComment): bool
    {
        return $authUser->can('ForceDelete:CmsComment');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:CmsComment');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:CmsComment');
    }

    public function replicate(AuthUser $authUser, CmsComment $cmsComment): bool
    {
        return $authUser->can('Replicate:CmsComment');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:CmsComment');
    }

}