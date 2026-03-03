<?php

declare(strict_types=1);

namespace Modules\Location\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Modules\Location\Models\Country;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Country');
    }

    public function view(AuthUser $authUser, Country $country): bool
    {
        return $authUser->can('View:Country');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Country');
    }

    public function update(AuthUser $authUser, Country $country): bool
    {
        return $authUser->can('Update:Country');
    }

    public function delete(AuthUser $authUser, Country $country): bool
    {
        return $authUser->can('Delete:Country');
    }

    public function restore(AuthUser $authUser, Country $country): bool
    {
        return $authUser->can('Restore:Country');
    }

    public function forceDelete(AuthUser $authUser, Country $country): bool
    {
        return $authUser->can('ForceDelete:Country');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Country');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Country');
    }

    public function replicate(AuthUser $authUser, Country $country): bool
    {
        return $authUser->can('Replicate:Country');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Country');
    }

}