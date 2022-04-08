<?php namespace Anomaly\UsersModule\User\Validation;

use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Login\LoginFormBuilder;
use Anomaly\UsersModule\User\UserAuthenticator;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ValidateCredentials
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ValidateCredentials
{

    /**
     * Handle the validation.
     *
     * @param  UserAuthenticator $authenticator
     * @param  LoginFormBuilder $builder
     * @return bool
     */
    public function handle(UserAuthenticator $authenticator, LoginFormBuilder $builder)
    {
        if (!$response = $authenticator->authenticate($builder->getPostData())) {
            return false;
        }

        if ($response instanceof UserInterface) {
            $builder->setUser($response);
        }

        if ($response instanceof Response) {
            $builder->setFormResponse($response);
        }

        return true;
    }
}
