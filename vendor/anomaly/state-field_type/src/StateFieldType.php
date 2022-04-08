<?php namespace Anomaly\StateFieldType;

use Anomaly\StateFieldType\Command\BuildOptions;
use Anomaly\StateFieldType\Handler\DefaultHandler;
use Anomaly\StateFieldType\Validation\ValidateState;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class StateFieldType
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class StateFieldType extends FieldType
{

    /**
     * The field class.
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
    protected $filterView = 'anomaly.field_type.state::filter';

    /**
     * The field type config.
     *
     * @var array
     */
    protected $config = [
        'handler' => 'Anomaly\StateFieldType\Handler\DefaultHandler@handle',
    ];

    /**
     * The validation rules.
     *
     * @var array
     */
    protected $rules = [
        'valid_state',
    ];

    /**
     * The custom validators.
     *
     * @var array
     */
    protected $validators = [
        'valid_state' => [
            'handler' => ValidateState::class,
            'message' => 'anomaly.field_type.state::message.invalid_state',
        ],
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
        if ($this->options == null) {
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
     * Get the placeholder.
     *
     * @return null|string
     */
    public function getPlaceholder()
    {
        if (!$this->placeholder && !$this->isRequired() && $this->config('mode') == 'dropdown') {
            return 'anomaly.field_type.state::input.placeholder';
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

        return 'anomaly.field_type.state::' . $this->config('mode', 'input');
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

        return $this->config('mode') == 'dropdown' ? 'custom-select form-control' : 'form-control';
    }
}
