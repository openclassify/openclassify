<?php namespace Anomaly\ConfigurationModule\Configuration;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationInterface;
use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeCollection;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Anomaly\Streams\Platform\Entry\EntryRepository;
use Illuminate\Contracts\Config\Repository;

/**
 * Class ConfigurationRepositoryInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ConfigurationRepository extends EntryRepository implements ConfigurationRepositoryInterface
{

    /**
     * The configuration model.
     *
     * @var ConfigurationModel
     */
    protected $model;

    /**
     * The configurations collection.
     *
     * @var ConfigurationCollection
     */
    protected $configurations;

    /**
     * Create a new ConfigurationRepositoryInterface instance.
     *
     * @param ConfigurationModel  $model
     * @param Repository          $config
     * @param FieldTypeCollection $fieldTypes
     */
    public function __construct(ConfigurationModel $model)
    {
        $this->model = $model;

        $this->configurations = $this->model->all();
    }

    /**
     * Get a configuration.
     *
     * @param $key
     * @param $scope
     * @return ConfigurationInterface|null
     */
    public function get($key, $scope)
    {
        return $this->configurations->get($key . $scope);
    }

    /**
     * Set a configurations value.
     *
     * @param $key
     * @param $scope
     * @param $value
     * @return bool
     */
    public function set($key, $scope, $value)
    {
        $configuration = $this->findByKeyAndScopeOrNew($key, $scope);

        $configuration->setValue($value);

        return $this->save($configuration);
    }

    /**
     * Get a configuration value.
     *
     * @param             $key
     * @param             $scope
     * @param  null       $default
     * @return mixed|null
     */
    public function value($key, $scope, $default = null)
    {
        if ($configuration = $this->get($key, $scope)) {
            return $configuration->getValue();
        }

        return $default;
    }

    /**
     * Get a configuration value presenter instance.
     *
     * @param $key
     * @param $scope
     * @return FieldTypePresenter|null
     */
    public function presenter($key, $scope)
    {
        if ($configuration = $this->get($key, $scope)) {
            return $configuration->getFieldTypePresenter('value');
        }

        return null;
    }

    /**
     * Find a configuration by it's key
     * or return a new instance.
     *
     * @param $key
     * @param $scope
     * @return ConfigurationInterface
     */
    public function findByKeyAndScopeOrNew($key, $scope)
    {
        if (!$configuration = $this->model->where('key', $key)->where('scope', $scope)->first()) {

            $configuration = $this->model->newInstance();

            $configuration->setKey($key);
            $configuration->setScope($scope);
        }

        return $configuration;
    }

    /**
     * Purge a namespace's configuration.
     *
     * @param $namespace
     * @return $this
     */
    public function purge($namespace)
    {
        $this->model->where('key', 'LIKE', $namespace . '::%')->delete();

        return $this;
    }
}
