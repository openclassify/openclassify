<?php namespace Anomaly\UsersModule\User;

use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Event\SecurityCheckHasFailed;
use Anomaly\UsersModule\User\Security\Contract\SecurityCheckInterface;
use Illuminate\Routing\Redirector;

/**
 * Class UserSecurity
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class UserSecurity
{

    /**
     * The redirect service.
     *
     * @var Redirector
     */
    protected $redirect;

    /**
     * The extension collection.
     *
     * @var ExtensionCollection
     */
    protected $extensions;

    /**
     * Create a new SecurityChecker instance.
     *
     * @param ExtensionCollection $extensions
     */
    public function __construct(ExtensionCollection $extensions)
    {
        $this->extensions = $extensions;
    }

    /**
     * Check a login attempt.
     *
     * @return bool|\Illuminate\Http\RedirectResponse|mixed|string
     */
    public function attempt()
    {
        $extensions = $this->extensions->search('anomaly.module.users::security_check.*');

        /* @var SecurityCheckInterface $extension */
        foreach ($extensions as $extension) {

            /*
             * If the security check does not return
             * false then we can assume it passed.
             */

            $response = $extension->attempt();

            if ($response === true) {
                continue;
            }

            event(new SecurityCheckHasFailed($extension));

            return $response;
        }

        return true;
    }

    /**
     * Check authorization.
     *
     * @param  UserInterface $user
     * @return bool|\Illuminate\Http\RedirectResponse|mixed|string
     */
    public function check(UserInterface $user = null)
    {
        $extensions = $this->extensions
            ->search('anomaly.module.users::security_check.*')
            ->enabled();

        /* @var SecurityCheckInterface $extension */
        foreach ($extensions as $extension) {

            /*
             * If the security check does not return
             * false then we can assume it passed.
             */

            $response = $extension->check($user);

            if ($response === true) {
                continue;
            }

            event(new SecurityCheckHasFailed($extension));

            return $response;
        }

        return true;
    }
}
