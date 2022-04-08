<?php namespace Anomaly\UsersModule\User\Authenticator\Contract;

use Anomaly\UsersModule\User\Contract\UserInterface;

/**
 * Interface AuthenticatorExtensionInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface AuthenticatorExtensionInterface
{

    /**
     * Authenticate a set of credentials.
     *
     * @param  array $credentials
     * @return null|UserInterface
     */
    public function authenticate(array $credentials);
}
