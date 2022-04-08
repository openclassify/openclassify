<?php namespace Anomaly\ConfigurationModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class ConfigurationModuleServiceProvider
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ConfigurationModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        'Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface' => 'Anomaly\ConfigurationModule\Configuration\ConfigurationRepository',
    ];

}
