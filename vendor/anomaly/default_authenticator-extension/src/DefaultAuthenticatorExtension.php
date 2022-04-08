<?php namespace Anomaly\DefaultAuthenticatorExtension;

use Anomaly\DefaultAuthenticatorExtension\Command\AuthenticateCredentials;
use Anomaly\UsersModule\User\Authenticator\AuthenticatorExtension;
use Anomaly\UsersModule\User\Contract\UserInterface;

/**
 * Class DefaultAuthenticatorExtension
 *
 * Authenticator extensions should return a handler class
 * to do their dirty work.
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\Streams\Addon\Extension\UsersModuleDefaultAuthenticator
 */
class DefaultAuthenticatorExtension extends AuthenticatorExtension
{

    /**
     * This extensions provides the default
     * authenticator for the users module.
     *
     * @var string
     */
    protected $provides = 'anomaly.module.users::authenticator.default';

    /**
     * Authenticate a set of credentials.
     *
     * @param array $credentials
     * @return null|UserInterface
     */
    public function authenticate(array $credentials)
    {
        return $this->dispatch(new AuthenticateCredentials($credentials));
    }
}
