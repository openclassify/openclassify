<?php namespace Visiosoft\ConnectModule;

use Visiosoft\ConnectModule\Command\DeleteKeys;
use Visiosoft\ConnectModule\Command\GenerateKeys;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Console\Kernel;

/**
 * Class ConnectModule
 *

 * @package       Visiosoft\ConnectModule
 */
class ConnectModule extends Module
{

    /**
     * The navigation icon.
     *
     * @var string
     */
    protected $icon = 'keys';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'clients' => [
            'buttons' => [
                'new_client' => [
                    'permission' => 'visiosoft.module.connect::clients.write',
                ],
            ],
        ],
    ];

    /**
     * Fire after installing.
     *
     * @param Kernel $console
     */
    public function onInstalling(Kernel $console)
    {
        $console->call(
            'migrate',
            [
                '--path'  => 'vendor/laravel/passport/database/migrations/',
                '--force' => true,
            ]
        );

        $this->dispatch(new GenerateKeys());
    }

    /**
     * Fire after installing.
     *
     * @param Kernel $console
     */
    public function onUninstalled(Kernel $console)
    {
        $console->call(
            'migrate:reset',
            [
                '--path'  => 'vendor/laravel/passport/database/migrations/',
                '--force' => true,
            ]
        );

        $this->dispatch(new DeleteKeys());
    }
}
