<?php namespace Anomaly\Streams\Platform\Application\Command;

use Illuminate\Contracts\Config\Repository;

/**
 * Class SetCoreConnection
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetCoreConnection
{

    /**
     * Handle the command.
     *
     * @param Repository $config
     */
    public function handle(Repository $config)
    {
        $config->set(
            'database.connections.core',
            $config->get('database.connections.' . $config->get('database.default'))
        );
    }
}
