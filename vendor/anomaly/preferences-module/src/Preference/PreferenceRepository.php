<?php namespace Anomaly\PreferencesModule\Preference;

use Anomaly\PreferencesModule\Preference\Contract\PreferenceInterface;
use Anomaly\PreferencesModule\Preference\Contract\PreferenceRepositoryInterface;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Anomaly\Streams\Platform\Entry\EntryRepository;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class PreferenceRepository
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PreferenceRepository extends EntryRepository implements PreferenceRepositoryInterface
{

    /**
     * The preference model.
     *
     * @var PreferenceModel
     */
    protected $model;

    /**
     * The preferences collection.
     *
     * @var PreferenceCollection
     */
    protected $preferences;

    /**
     * Create a new PreferenceRepositoryInterface instance.
     *
     * @param Guard $auth
     * @param PreferenceModel $model
     */
    public function __construct(PreferenceModel $model)
    {
        $this->model = $model;

        $this->load();
    }

    /**
     * Load the preferences.
     */
    public function load()
    {
        $this->preferences = new PreferenceCollection();

        /* @var UserInterface $user */
        if ($user = auth()->user()) {
            $this->preferences = $this->model->belongingToUser($user)->get();
        }
    }

    /**
     * Return if a preference exists or not.
     *
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return $this->preferences->has($key);
    }

    /**
     * Get a preference.
     *
     * @param $key
     * @return null|PreferenceInterface
     */
    public function get($key)
    {
        return $this->preferences->get($key);
    }

    /**
     * Set a preferences value.
     *
     * @param $key
     * @param $value
     * @return bool
     */
    public function set($key, $value)
    {
        if (!$user = auth()->user()) {
            throw new \Exception('The user could not be determined.');
        }

        /* @var PreferenceInterface|EloquentModel $preference */
        $preference = $this->findByKeyOrNew($key);

        $preference->setUser($user);
        $preference->setValue($value);

        return $this->save($preference);
    }

    /**
     * Get a preference value presenter instance.
     *
     * @param                          $key
     * @param  null $default
     * @return FieldTypePresenter|null
     */
    public function value($key, $default = null)
    {
        if ($preference = $this->get($key)) {
            return $preference->getValue();
        }

        return $default;
    }

    /**
     * Return the field type
     * presenter for a preference.
     *
     * @param $key
     * @return FieldTypePresenter|null
     */
    public function presenter($key)
    {
        if ($preference = $this->get($key)) {
            return $preference->getFieldTypePresenter('value');
        }

        return null;
    }

    /**
     * Find a preference by it's key
     * or return a new instance.
     *
     * @param $key
     * @return PreferenceInterface
     */
    public function findByKeyOrNew($key)
    {
        /* @var UserInterface $user */
        if (!$user = auth()->user()) {
            throw new \Exception('The user could not be determined.');
        }

        if (!$preference = $this->model->where('key', $key)->where('user_id', $user->getId())->first()) {

            $preference = $this->model->newInstance();

            $preference->setKey($key);
            $preference->setUser($user);
        }

        return $preference;
    }

    /**
     * Find all preferences with namespace.
     *
     * @param $namespace
     * @return PreferenceCollection
     */
    public function findAllByNamespace($namespace)
    {
        return $this->model->where('key', 'LIKE', $namespace . '%')->get();
    }
}
