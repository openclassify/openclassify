<?php namespace Anomaly\SettingsModule\Setting;

use Anomaly\SettingsModule\Setting\Command\GetDefaultValue;
use Anomaly\SettingsModule\Setting\Contract\SettingInterface;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeCollection;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Anomaly\Streams\Platform\Entry\EntryRepository;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class SettingRepositoryInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SettingRepository extends EntryRepository implements SettingRepositoryInterface
{

    use DispatchesJobs;

    /**
     * The setting model.
     *
     * @var SettingModel
     */
    protected $model;

    /**
     * The settings collection.
     *
     * @var SettingCollection
     */
    protected $settings;

    /**
     * Create a new SettingRepositoryInterface instance.
     *
     * @param SettingModel $model
     * @param Repository $config
     * @param FieldTypeCollection $fieldTypes
     */
    public function __construct(SettingModel $model)
    {
        $this->model = $model;

        $this->load();
    }

    /**
     * Load the settings.
     *
     * @return $this
     */
    public function load()
    {
        $this->settings = $this->model->all();

        return $this;
    }

    /**
     * Return if the key exists or not.
     *
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return $this->settings->has($key);
    }

    /**
     * Set a settings value.
     *
     * @param $key
     * @param $value
     * @return bool
     */
    public function set($key, $value)
    {
        $setting = $this->findByKeyOrNew($key);

        $setting->setValue($value);

        return $this->save($setting);
    }

    /**
     * Find a setting by it's key
     * or return a new instance.
     *
     * @param $key
     * @return SettingInterface
     */
    public function findByKeyOrNew($key)
    {
        if (!$setting = $this->model->where('key', $key)->first()) {

            $setting = $this->model->newInstance();

            $setting->setKey($key);
        }

        return $setting;
    }

    /**
     * Get a setting value.
     *
     * @param             $key
     * @param  null $default
     * @return mixed|null
     */
    public function value($key, $default = null)
    {
        $setting = $this->get($key);

        if ($setting) {
            return $setting->getValue();
        }

        if (!$setting && !$default) {
            return $this->dispatch(new GetDefaultValue($key));
        }

        return $default;
    }

    /**
     * Get a setting.
     *
     * @param                                     $key
     * @param  null $default
     * @return null|SettingInterface|SettingModel
     */
    public function get($key, $default = null)
    {
        $setting = $this->settings->get($key);

        return ($setting) ? $setting : $default;
    }

    /**
     * Return the field type
     * presenter for a setting.
     *
     * @param $key
     * @return FieldTypePresenter|null
     */
    public function presenter($key)
    {
        if ($setting = $this->get($key)) {
            return $setting->getFieldTypePresenter('value');
        }

        return null;
    }

    /**
     * Find all settings with namespace.
     *
     * @param $namespace
     * @return SettingCollection
     */
    public function findAllByNamespace($namespace)
    {
        return $this->model->where('key', 'LIKE', $namespace . '%')->get();
    }
}
