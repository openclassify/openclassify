<?php namespace Anomaly\BlocksModule\Block\Traits;

/**
 * Class ProvidesStyle
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeModifier;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;

/**
 * Class ProvidesStyle
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
trait ProvidesStyle
{

    /**
     * Get the slug based on the parent.
     *
     * @return string
     */
    public function getSlug()
    {
        $segments = explode('\\', preg_replace("/FieldType$/", '', parent::class));

        return strtolower($segments[2]);
    }

    /**
     * Get the namespace using our slug.
     *
     * @param null $key
     * @return string
     */
    public function getNamespace($key = null)
    {
        return 'anomaly.field_type.' . $this->getSlug() . ($key ? '::' . $key : $key);
    }

    /**
     * Get the modifier.
     *
     * @return FieldTypeModifier
     */
    public function getModifier()
    {
        /* @var FieldTypeModifier $modifier */
        if (is_object($modifier = $this->modifier)) {
            return $modifier->setFieldType($this);
        }

        if (!$this->modifier) {
            $this->modifier = parent::class . 'Modifier';
        }

        if (!class_exists($this->modifier)) {
            $this->modifier = FieldTypeModifier::class;
        }

        $modifier = app()->make($this->modifier);

        $modifier->setFieldType($this);

        return $this->modifier = $modifier;
    }

    /**
     * Get the presenter.
     *
     * @return FieldTypePresenter
     */
    public function getPresenter()
    {
        if (!$this->presenter) {
            $this->presenter = parent::class . 'Presenter';
        }

        if (!class_exists($this->presenter)) {
            $this->presenter = FieldTypePresenter::class;
        }

        return app()->make($this->presenter, ['object' => $this]);
    }

    /**
     * Return the CSS style.
     *
     * @param null $default
     * @return string
     */
    public function css($default = null)
    {

        /**
         * If there is nothing to be done
         * then don't print a rule at all.
         */
        if ($this->getValue() === null && $default == null) {
            return '';
        }

        $name = snake_case(str_replace('FieldType', '', (new \ReflectionClass($this))->getShortName()));

        return str_replace('_', '-', $name . ': ' . ($this->getValue() ?: $default) . ';');
    }
}
