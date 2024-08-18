<?php namespace Anomaly\UsersModule;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\Streams\Platform\Support\Decorator;
use Anomaly\UsersModule\Role\Command\GetRole;
use Anomaly\UsersModule\User\Command\GetUser;
use Anomaly\UsersModule\User\UserMentions;
use Twig\TwigFunction;
use Twig\TwigFilter;

/**
 * Class UsersModulePlugin
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UsersModulePlugin extends Plugin
{

    /**
     * Get the functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new TwigFunction(
                'user',
                function ($identifier = null) {
                    return (new Decorator())->decorate(dispatch_sync(new GetUser($identifier)));
                }
            ),
            new TwigFunction(
                'role',
                function ($identifier) {
                    return (new Decorator())->decorate(dispatch_sync(new GetRole($identifier)));
                }
            ),
            new TwigFunction(
                'mentions_*',
                function ($name) {
                    $arguments = array_slice(func_get_args(), 1);

                    return call_user_func_array([app(UserMentions::class), camel_case($name)], $arguments);
                },
                [
                    'is_safe' => ['html'],
                ]
            ),
        ];
    }

    /**
     * Get the filters.
     *
     * @return array
     */
    public function getFilters()
    {
        return [
            new TwigFilter(
                'mentions_*',
                function ($name) {
                    $arguments = array_slice(func_get_args(), 1);

                    return call_user_func_array([app(UserMentions::class), camel_case($name)], $arguments);
                }
            ),
        ];
    }
}
