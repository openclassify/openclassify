<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use TallCms\Cms\Models\MediaCollection;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediaCollectionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:MediaCollection');
    }

    public function view(AuthUser $authUser, MediaCollection $mediaCollection): bool
    {
        return $authUser->can('View:MediaCollection');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:MediaCollection');
    }

    public function update(AuthUser $authUser, MediaCollection $mediaCollection): bool
    {
        return $authUser->can('Update:MediaCollection');
    }

    public function delete(AuthUser $authUser, MediaCollection $mediaCollection): bool
    {
        return $authUser->can('Delete:MediaCollection');
    }

    public function restore(AuthUser $authUser, MediaCollection $mediaCollection): bool
    {
        return $authUser->can('Restore:MediaCollection');
    }

    public function forceDelete(AuthUser $authUser, MediaCollection $mediaCollection): bool
    {
        return $authUser->can('ForceDelete:MediaCollection');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:MediaCollection');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:MediaCollection');
    }

    public function replicate(AuthUser $authUser, MediaCollection $mediaCollection): bool
    {
        return $authUser->can('Replicate:MediaCollection');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:MediaCollection');
    }

}