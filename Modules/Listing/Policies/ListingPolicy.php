<?php

declare(strict_types=1);

namespace Modules\Listing\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Modules\Listing\Models\Listing;
use Illuminate\Auth\Access\HandlesAuthorization;

class ListingPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Listing');
    }

    public function view(AuthUser $authUser, Listing $listing): bool
    {
        return $authUser->can('View:Listing');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Listing');
    }

    public function update(AuthUser $authUser, Listing $listing): bool
    {
        return $authUser->can('Update:Listing');
    }

    public function delete(AuthUser $authUser, Listing $listing): bool
    {
        return $authUser->can('Delete:Listing');
    }

    public function restore(AuthUser $authUser, Listing $listing): bool
    {
        return $authUser->can('Restore:Listing');
    }

    public function forceDelete(AuthUser $authUser, Listing $listing): bool
    {
        return $authUser->can('ForceDelete:Listing');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Listing');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Listing');
    }

    public function replicate(AuthUser $authUser, Listing $listing): bool
    {
        return $authUser->can('Replicate:Listing');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Listing');
    }

}