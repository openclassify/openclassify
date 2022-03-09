<?php

namespace Anomaly\ThrottleSecurityCheckExtension\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\ThrottleSecurityCheckExtension\ThrottleSecurityCheckExtension;
use Anomaly\UsersModule\User\UserAuthenticator;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * Class ThrottleLogin
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ThrottleLogin
{

    use DispatchesJobs;

    /**
     * Handle the command.
     *
     * @param  Repository                     $cache
     * @param  Request                        $request
     * @param  UserAuthenticator              $authenticator
     * @param  SettingRepositoryInterface     $settings
     * @param  ThrottleSecurityCheckExtension $extension
     * @return bool
     */
    public function handle(
        Repository $cache,
        Request $request,
        UserAuthenticator $authenticator,
        SettingRepositoryInterface $settings,
        ThrottleSecurityCheckExtension $extension
    ) {
        $maxAttempts = $settings->value('anomaly.extension.throttle_security_check::max_attempts', 5);

        $lockoutInterval  = (new Carbon('now'))->addMinutes(
            $settings->value('anomaly.extension.throttle_security_check::lockout_interval', 1)
        );

        $throttleInterval = (new Carbon('now'))->addMinutes(
            $settings->value('anomaly.extension.throttle_security_check::throttle_interval', 1)
        );

        $attempts   = $cache->get($extension->getNamespace('attempts:' . $request->ip()), 1);
        $expiration = $cache->get($extension->getNamespace('expiration:' . $request->ip()));

        if ($expiration || $attempts >= $maxAttempts) {

            $cache->put($extension->getNamespace('attempts:' . $request->ip()), $attempts + 1, $throttleInterval);
            $cache->put($extension->getNamespace('expiration:' . $request->ip()), time(), $lockoutInterval);

            $authenticator->logout(); // Just for safe measure.

            return $this->dispatch(new MakeResponse());
        }

        $cache->put($extension->getNamespace('attempts:' . $request->ip()), $attempts + 1, $throttleInterval);

        return true;
    }
}
