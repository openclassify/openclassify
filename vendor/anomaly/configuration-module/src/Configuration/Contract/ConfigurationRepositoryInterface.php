<?php namespace Anomaly\ConfigurationModule\Configuration\Contract;

use Anomaly\ConfigurationModule\Configuration\ConfigurationModel;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface ConfigurationRepositoryInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface ConfigurationRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Get a configuration.
     *
     * @param $key
     * @param $scope
     * @return ConfigurationModel|ConfigurationInterface|null
     */
    public function get($key, $scope);

    /**
     * Set a configurations value.
     *
     * @param $key
     * @param $scope
     * @param $value
     * @return bool
     */
    public function set($key, $scope, $value);

    /**
     * Get a configuration value presenter instance.
     *
     * @param                          $key
     * @param                          $scope
     * @param  null                    $default
     * @return mixed|null
     */
    public function value($key, $scope, $default = null);

    /**
     * Get a configuration value presenter instance.
     *
     * @param $key
     * @param $scope
     * @return FieldTypePresenter|null
     */
    public function presenter($key, $scope);

    /**
     * Find a configuration by it's key
     * or return a new instance.
     *
     * @param $key
     * @param $scope
     * @return ConfigurationInterface
     */
    public function findByKeyAndScopeOrNew($key, $scope);

    /**
     * Purge a namespace's configuration.
     *
     * @param $namespace
     * @return $this
     */
    public function purge($namespace);
}
