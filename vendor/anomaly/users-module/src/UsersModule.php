<?php namespace Anomaly\UsersModule;

use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\UsersModule\Role\Command\SetGuestRole;

/**
 * Class UsersModule
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UsersModule extends Module
{

    /**
     * The module icon.
     *
     * @var string
     */
    protected $icon = 'users';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'users'  => [
            'buttons' => [
                'new_user',
            ],
        ],
        'roles'  => [
            'buttons' => [
                'new_role',
            ],
        ],
        'fields' => [
            'buttons' => [
                'add_field' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/users/fields/choose',
                ],
            ],
        ],
    ];

    /**
     * Fire after the addon registers.
     */
    public function onRegistered()
    {
        if ($this->isInstalled()) {
            $this->dispatch(new SetGuestRole());
        }
    }

}
