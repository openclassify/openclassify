<?php namespace Anomaly\PreferencesModule\Preference\Contract;

use Anomaly\PreferencesModule\Preference\PreferenceCollection;
use Anomaly\PreferencesModule\Preference\PreferenceModel;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface PreferenceRepositoryInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface PreferenceRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Load preferences.
     */
    public function load();

    /**
     * Return if a preference exists or not.
     *
     * @param $key
     * @return bool
     */
    public function has($key);

    /**
     * Get a preference.
     *
     * @param $key
     * @return null|PreferenceInterface|PreferenceModel
     */
    public function get($key);

    /**
     * Set a preferences value.
     *
     * @param $key
     * @param $value
     * @return bool
     */
    public function set($key, $value);

    /**
     * Get a preference value presenter instance.
     *
     * @param                          $key
     * @param  null                    $default
     * @return FieldTypePresenter|null
     */
    public function value($key, $default = null);

    /**
     * Return the field type
     * presenter for a preference.
     *
     * @param $key
     * @return FieldTypePresenter|null
     */
    public function presenter($key);

    /**
     * Find a preference by it's key
     * or return a new instance.
     *
     * @param $key
     * @return PreferenceInterface
     */
    public function findByKeyOrNew($key);

    /**
     * Find all preferences with namespace.
     *
     * @param $namespace
     * @return PreferenceCollection
     */
    public function findAllByNamespace($namespace);
}
