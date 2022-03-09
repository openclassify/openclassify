<?php namespace Anomaly\PreferencesModule\Preference\Contract;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\UsersModule\User\Contract\UserInterface;

/**
 * Interface PreferenceInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface PreferenceInterface extends EntryInterface
{

    /**
     * Return the value field.
     *
     * @return FieldType
     */
    public function field();

    /**
     * Get the key.
     *
     * @return string
     */
    public function getKey();

    /**
     * Set the key.
     *
     * @param $key
     * @return $this
     */
    public function setKey($key);

    /**
     * Get the user.
     *
     * @return UserInterface
     */
    public function getUser();

    /**
     * Set the user.
     *
     * @param  UserInterface $user
     * @return $this
     */
    public function setUser(UserInterface $user);

    /**
     * Get the value.
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Set the value.
     *
     * @param $value
     * @return $this
     */
    public function setValue($value);

    /**
     * Get the field type's presenter
     * for a given field slug.
     *
     * We're overriding this to catch
     * the "value" key.
     *
     * @param $fieldSlug
     * @return FieldTypePresenter
     */
    public function getFieldTypePresenter($fieldSlug);
}
