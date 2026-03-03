<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use TallCms\Cms\Models\TallcmsContactSubmission;
use Illuminate\Auth\Access\HandlesAuthorization;

class TallcmsContactSubmissionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TallcmsContactSubmission');
    }

    public function view(AuthUser $authUser, TallcmsContactSubmission $tallcmsContactSubmission): bool
    {
        return $authUser->can('View:TallcmsContactSubmission');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TallcmsContactSubmission');
    }

    public function update(AuthUser $authUser, TallcmsContactSubmission $tallcmsContactSubmission): bool
    {
        return $authUser->can('Update:TallcmsContactSubmission');
    }

    public function delete(AuthUser $authUser, TallcmsContactSubmission $tallcmsContactSubmission): bool
    {
        return $authUser->can('Delete:TallcmsContactSubmission');
    }

    public function restore(AuthUser $authUser, TallcmsContactSubmission $tallcmsContactSubmission): bool
    {
        return $authUser->can('Restore:TallcmsContactSubmission');
    }

    public function forceDelete(AuthUser $authUser, TallcmsContactSubmission $tallcmsContactSubmission): bool
    {
        return $authUser->can('ForceDelete:TallcmsContactSubmission');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TallcmsContactSubmission');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TallcmsContactSubmission');
    }

    public function replicate(AuthUser $authUser, TallcmsContactSubmission $tallcmsContactSubmission): bool
    {
        return $authUser->can('Replicate:TallcmsContactSubmission');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TallcmsContactSubmission');
    }

}