<?php namespace Visiosoft\ConnectModule\Command;

class CreateTranslatableValues
{
    protected $params;
    protected $unique_value;

    public function __construct(array $params, $unique_value = "")
    {
        $this->params = $params;
        $this->unique_value = $unique_value;
    }

    public function handle()
    {
        $new_parameters = [];
        foreach ($this->params as $key => $value) {
            $new_parameters = array_merge_recursive($new_parameters, $this->createValue($key, $value));
        }

        return $new_parameters;
    }

    public function enabledLocales()
    {
        $enabled_locales = config('streams::locales.enabled', setting_value('streams::enabled_locales', []));
        $default_locale = config('streams::locales.default', setting_value('streams::default_locale'));

        if ($default_locale and !in_array($default_locale, $enabled_locales)) {
            array_push($enabled_locales, config('streams::locales.default', setting_value('streams::default_locale')));
        }

        return $enabled_locales;
    }

    public function createValue($key, $value)
    {
        if (is_array($value)) {
            $new_parameters = [];

            foreach ($this->enabledLocales() as $locale) {
                if (isset($value[$locale])) {

                    $new_parameters[$locale][$key] = $value[$locale];

                    if ($key == "slug") {
                        $new_parameters[$locale][$key] = $value[$locale] . "-" . $this->unique_value;
                    }
                }
            }

            return $new_parameters;
        }

        return [$key => $value];
    }
}
