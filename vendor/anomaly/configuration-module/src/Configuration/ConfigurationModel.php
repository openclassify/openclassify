<?php namespace Anomaly\ConfigurationModule\Configuration;

use Anomaly\ConfigurationModule\Configuration\Command\GetValueFieldType;
use Anomaly\ConfigurationModule\Configuration\Command\GetValuePresenter;
use Anomaly\ConfigurationModule\Configuration\Command\ModifyValue;
use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationInterface;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Anomaly\Streams\Platform\Model\Configuration\ConfigurationConfigurationEntryModel;

/**
 * Class ConfigurationModel
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ConfigurationModel extends ConfigurationConfigurationEntryModel implements ConfigurationInterface
{

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
     * Get the scope.
     *
     * @return mixed
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Set the scope.
     *
     * @param $scope
     * @return $this
     */
    public function setScope($scope)
    {
        $this->scope = $scope;

        return $this;
    }

    /**
     * Get the value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value.
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
     * Get the field type's presenter
     * for a given field slug.
     *
     * We're overriding this to catch
     * the "value" key.
     *
     * @param $fieldSlug
     * @return FieldTypePresenter
     */
    public function getFieldTypePresenter($fieldSlug)
    {
        if ($fieldSlug == 'value') {
            return $this->dispatch(new GetValuePresenter($this));
        }

        return parent::getFieldTypePresenter($fieldSlug);
    }
}
