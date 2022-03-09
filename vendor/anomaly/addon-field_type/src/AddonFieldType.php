<?php namespace Anomaly\AddonFieldType;

use Anomaly\AddonFieldType\Command\BuildOptions;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class AddonFieldType
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddonFieldType extends FieldType
{

    /**
     * The field type class.
     *
     * @var null
     */
    protected $class = null;

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = null;

    /**
     * The filter view.
     *
     * @var string
     */
    protected $filterView = 'anomaly.field_type.addon::filter';

    /**
     * The field type config.
     *
     * @var array
     */
    protected $config = [
        'mode'    => 'dropdown',
        'handler' => \Anomaly\AddonFieldType\Handler\DefaultHandler::class,
    ];

    /**
     * The dropdown options.
     *
     * @var null|array
     */
    protected $options = null;

    /**
     * Get the options.
     *
     * @return array
     */
    public function getOptions()
    {
        if ($this->options === null) {
            $this->dispatch(new BuildOptions($this));
        }

        return $this->options;
    }

    /**
     * Set the options.
     *
     * @param  array $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get the placeholder.
     *
     * @return null|string
     */
    public function getPlaceholder()
    {
        if (!$this->placeholder && !$this->isRequired()) {
            return 'anomaly.field_type.addon::input.placeholder';
        }

        return $this->placeholder;
    }

    /**
     * Return the input view.
     *
     * @return string
     */
    public function getInputView()
    {
        if ($view = parent::getInputView()) {
            return $view;
        }

        return 'anomaly.field_type.addon::' . $this->config('mode', 'dropdown');
    }

    /**
     * Get the class.
     *
     * @return null|string
     */
    public function getClass()
    {
        if ($class = parent::getClass()) {
            return $class;
        }

        return $this->config('mode') == 'dropdown'
            ? 'custom-select form-control'
            : 'c-inputs-stacked';
    }

}
