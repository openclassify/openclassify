<?php
declare(strict_types=1);

namespace Visiosoft\AdvsModule;

use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class EidsService
{
    /**
     *  EIDS is a Turkish real estate verification system. This service only works in Turkey.
     */

    public static function isEidsRequired()
    {
        return (bool)setting_value('visiosoft.module.advs::is_eids_verification_required');
    }

    public static function isUserVerified(): bool
    {
        return Auth::user()->is_eids_verified;
    }

    public static function redirectToLogin()
    {
        $loginAddress = setting_value('visiosoft.module.advs::eids_verification_url');
        if (empty($loginAddress)) {
            throw new \Exception('eids verification address cannot be empty, set it from the admin panel');
        }

        $loginAddress .= "&id=" . Auth::id();

        return redirect($loginAddress);
    }
}