<?php namespace Anomaly\SelectFieldType;

use Anomaly\SelectFieldType\Command\BuildOptions;
use Anomaly\SelectFieldType\Handler\Countries;
use Anomaly\SelectFieldType\Handler\Currencies;
use Anomaly\SelectFieldType\Handler\Emails;
use Anomaly\SelectFieldType\Handler\Layouts;
use Anomaly\SelectFieldType\Handler\Months;
use Anomaly\SelectFieldType\Handler\Options;
use Anomaly\SelectFieldType\Handler\States;
use Anomaly\SelectFieldType\Handler\Timezones;
use Anomaly\SelectFieldType\Handler\Years;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class SelectFieldType
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SelectFieldType extends FieldType
{

    use DispatchesJobs;

    /**
     * No default class.
     *
     * @var null
     */
    protected $class = null;

    /**
     * The input view.
     *
     * @var null|string
     */
    protected $inputView = null;

    /**
     * The filter view.
     *
     * @var string
     */
    protected $filterView = 'anomaly.field_type.select::filter';

    /**
     * The field type config.
     *
     * @var array
     */
    protected $config = [
        'selector' => ':',
        'handler'  => 'options',
        'mode'     => 'dropdown',
    ];

    /**
     * The option handlers.
     *
     * @var array
     */
    protected $handlers = [
        'years'      => Years::class,
        'emails'     => Emails::class,
        'states'     => States::class,
        'months'     => Months::class,
        'layouts'    => Layouts::class,
        'options'    => Options::class,
        'countries'  => Countries::class,
        'timezones'  => Timezones::class,
        'currencies' => Currencies::class,
    ];

    /**
     * The dropdown options.
     *
     * @var null|array
     */
    protected $options = null;

    /**
     * Get the dropdown options.
     *
     * @return array
     */
    public function getOptions()
    {
        if ($this->options === null) {
            $this->dispatch(new BuildOptions($this));
        }

        $topOptions = array_get($this->getConfig(), 'top_options');

        if (!is_array($topOptions)) {
            $topOptions = array_filter(array_reverse(explode("\r\n", $topOptions)));
        }

        foreach ($topOptions as $key) {
            $this->options = [$key => $this->options[$key]] + $this->options;
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
     * Merge more options on.
     *
     * @param array $options
     * @return $this
     */
    public function mergeOptions(array $options)
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }

    /**
     * Get the handlers.
     *
     * @return array
     */
    public function getHandlers()
    {
        return $this->handlers;
    }

    /**
     * Get the placeholder.
     *
     * @return null|string
     */
    public function getPlaceholder()
    {
        if (!$this->placeholder) {
            return 'anomaly.field_type.select::input.placeholder';
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

        return 'anomaly.field_type.select::' . $this->config('mode', 'dropdown');
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
            : null;
    }

    /**
     * Implode array options into a string
     * so that they can be edited in the CP.
     *
     * @param array $config
     */
    protected function implodeOptions(array &$config)
    {
        if (isset($config['options']) && is_array($config['options'])) {

            array_walk(
                $config['options'],
                function (&$value, $key) {
                    return $value = $key . ': ' . $value;
                }
            );

            $config['options'] = implode("\n", $config['options']);
        }
    }

}
