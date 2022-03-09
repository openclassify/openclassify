<?php namespace Anomaly\SettingsModule\Setting;

use Anomaly\SettingsModule\Setting\Command\GetValueFieldType;
use Anomaly\SettingsModule\Setting\Command\GetValuePresenter;
use Anomaly\SettingsModule\Setting\Command\ModifyValue;
use Anomaly\SettingsModule\Setting\Contract\SettingInterface;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Anomaly\Streams\Platform\Model\Settings\SettingsSettingsEntryModel;

/**
 * Class SettingModel
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SettingModel extends SettingsSettingsEntryModel implements SettingInterface
{

    /**
     * Get the key.
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set the key.
     *
     * @param $key
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get the value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value attribute.
     *
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get the field type's presenter for a given field slug.
     * We're overriding this to catch the "value" key.
     *
     * @param $fieldSlug
     *
     * @return FieldTypePresenter
     */
    public function getFieldTypePresenter($fieldSlug)
    {
        return $fieldSlug == 'value'
            ? $this->dispatch(new GetValuePresenter($this))
            : parent::getFieldTypePresenter($fieldSlug);
    }

    /**
     * Set the value.
     *
     * @param $value
     * @return $this
     */
    protected function setValueAttribute($value)
    {
        $this->attributes['value'] = $this->dispatch(new ModifyValue($this, $value));

        return $this;
    }

    /**
     * Get the value attribute.
     *
     * @return mixed
     */
    protected function getValueAttribute()
    {
        if (!$field = $this->field()) {
            return null;
        }

        return $field->getValue();
    }

    /**
     * Return the value field.
     *
     * @return FieldType
     */
    public function field()
    {
        /* @var FieldType $field */
        $field = $this->dispatch(new GetValueFieldType($this));

        if (!$field) {
            return null;
        }

        return $field;
    }
}
