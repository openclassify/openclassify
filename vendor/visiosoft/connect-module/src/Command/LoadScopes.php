<?php namespace Visiosoft\ConnectModule\Command;

use Illuminate\Contracts\Config\Repository;
use Laravel\Passport\Passport;

/**
 * Class LoadScopes
 *

 */
class LoadScopes
{

    /**
     * Handle the command.
     *
     * @param Repository $config
     */
    public function handle(Repository $config)
    {
        Passport::tokensCan($config->get('visiosoft.module.connect::api.scopes'));
    }
}
