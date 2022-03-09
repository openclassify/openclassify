<?php namespace Anomaly\LanguageFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class LanguageFieldType
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class LanguageFieldType extends FieldType
{

    /**
     * The input view.
     *
     * @var null
     */
    protected $inputView = null;

    /**
     * The default config.
     *
     * @var array
     */
    protected $config = [
        'mode'          => 'dropdown',
        'default_value' => 'en',
    ];

    /**
     * Get the options.
     *
     * @return array
     */
    public function getOptions()
    {
        $locales = array_keys(config('streams::locales.supported'));

        $names = array_map(
            function ($locale) {
                return 'streams::locale.' . $locale . '.name';
            },
            $locales
        );

        $options = array_combine($locales, $names);

        asort($options);

        $topOptions = array_get($this->getConfig(), 'top_options');

        if (!is_array($topOptions)) {
            $topOptions = array_filter(array_reverse(explode("\r\n", $topOptions)));
        }

        foreach ($topOptions as $locale) {
            $options = [$locale => $options[$locale]] + $options;
        }

        return array_unique($options);
    }

    /**
     * Get the placeholder.
     *
     * @return null|string
     */
    public function getPlaceholder()
    {
        return $this->placeholder ?: 'anomaly.field_type.language::input.placeholder';
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

        return 'anomaly.field_type.language::' . $this->config('mode', 'dropdown');
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
