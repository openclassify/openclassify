<?php namespace Anomaly\SettingsModule\Setting\Command;

use Anomaly\Streams\Platform\Support\Resolver;
use Illuminate\Contracts\Config\Repository;


/**
 * Class GetDefaultValue
 *
 * @link          http://fritzandandre.com
 * @author        Brennon Loveless <brennon@fritzandandre.com>
 */
class GetDefaultValue
{

    /**
     * The qualified key of the setting.
     *
     * {namespace}::{key}
     *
     * @var string
     */
    protected $key;

    /**
     * GetDefaultValue constructor.
     *
     * @param $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * Look for a default value from the config definition file. If it has one then return it, otherwise return null.
     *
     * @param  Repository $config
     * @param  Resolver $resolver
     * @return mixed
     */
    public function handle(Repository $config, Resolver $resolver)
    {
        list($namespace, $key) = explode('::', $this->key);

        if (!$fields = $config->get($namespace . '::settings/settings')) {
            $fields = $config->get($namespace . '::settings');
        }

        return $resolver->resolve(array_get($fields, $key . '.config.default_value', null));
    }
}
