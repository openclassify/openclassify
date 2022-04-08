<?php namespace Anomaly\CountryFieldType;

use Anomaly\CountryFieldType\Command\BuildOptions;
use Anomaly\CountryFieldType\Validation\ValidateCountry;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class CountryFieldType
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class CountryFieldType extends FieldType
{

    /**
     * The input class.
     *
     * @var string
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
    protected $filterView = 'anomaly.field_type.country::filter';

    /**
     * The default config.
     *
     * @var array
     */
    protected $config = [
        'handler' => 'Anomaly\CountryFieldType\Handler\DefaultHandler@handle',
    ];

    /**
     * The validation rules.
     *
     * @var array
     */
    protected $rules = [
        'valid_country',
    ];

    /**
     * The custom validators.
     *
     * @var array
     */
    protected $validators = [
        'valid_country' => [
            'handler' => ValidateCountry::class,
            'message' => 'anomaly.field_type.country::message.invalid_country',
        ],
    ];

    /**
     * The dropdown options.
     *
     * @var null|array
     */
    protected $options = null;

    /**
     * Get the countries.
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

        foreach ($topOptions as $iso) {
            if (isset($this->options[$iso])) {
                $this->options = [$iso => $this->options[$iso]] + $this->options;
            }
        }

        return array_unique($this->options);
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
        if (!$this->placeholder && !$this->isRequired() && $this->config('mode') == 'dropdown') {
            return 'anomaly.field_type.country::input.placeholder';
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

        return 'anomaly.field_type.country::' . $this->config('mode', 'input');
    }

    /**
     * Get the class.s
     *
     * @return null|string
     */
    public function getClass()
    {
        if ($class = parent::getClass()) {
            return $class;
        }

        return $this->config('mode') == 'dropdown' ? 'custom-select form-control' : 'form-control';
    }
}
