<?php namespace Anomaly\Streams\Platform\Ui\Command;

/**
 * Class GetTranslatedString
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetTranslatedString
{

    /**
     * The translation key.
     *
     * @var string
     */
    protected $key;

    /**
     * The locale key.
     *
     * @var string
     */
    protected $locale;

    /**
     * The translation parameters.
     *
     * @var array
     */
    protected $parameters;

    /**
     * Create a new GetTranslatedString instance.
     *
     * @param string $key
     * @param array $parameters
     * @param string $locale
     */
    public function __construct($key, array $parameters, $locale)
    {
        $this->key        = $key;
        $this->locale     = $locale;
        $this->parameters = $parameters;
    }

    /**
     * Handle the command.
     *
     * @return string
     */
    public function handle()
    {
        if (!$this->key) {
            return $this->key;
        }

        if (is_array($string = trans($this->key, $this->parameters, $this->locale))) {
            return $this->key;
        }

        return $string;
    }
}
