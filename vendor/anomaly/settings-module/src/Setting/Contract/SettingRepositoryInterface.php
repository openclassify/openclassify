<?php namespace Anomaly\SettingsModule\Setting\Contract;

use Anomaly\SettingsModule\Setting\SettingCollection;
use Anomaly\SettingsModule\Setting\SettingModel;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface SettingRepositoryInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface SettingRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Load the settings.
     *
     * @return $this
     */
    public function load();

    /**
     * Return if the key exists or not.
     *
     * @param $key
     * @return bool
     */
    public function has($key);

    /**
     * Get a setting.
     *
     * @param                                     $key
     * @param  null $default
     * @return null|SettingInterface|SettingModel
     */
    public function get($key, $default = null);

    /**
     * Set a settings value.
     *
     * @param $key
     * @param $value
     * @return bool
     */
    public function set($key, $value);

    /**
     * Get a setting value.
     *
     * @param             $key
     * @param  null $default
     * @return mixed|null
     */
    public function value($key, $default = null);

    /**
     * Return the field type
     * presenter for a setting.
     *
     * @param $key
     * @return FieldTypePresenter|null
     */
    public function presenter($key);

    /**
     * Find a setting by it's key
     * or return a new instance.
     *
     * @param $key
     * @return SettingInterface
     */
    public function findByKeyOrNew($key);

    /**
     * Find all settings with namespace.
     *
     * @param $namespace
     * @return SettingCollection
     */
    public function findAllByNamespace($namespace);
}
