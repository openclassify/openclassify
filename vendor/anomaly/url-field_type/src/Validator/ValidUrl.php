<?php namespace Anomaly\UrlFieldType\Validator;

use Anomaly\Streams\Platform\Routing\UrlGenerator;
use Illuminate\Routing\Router;

/**
 * Class ValidUrl
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ValidUrl
{

    /**
     * The URL generator.
     *
     * @var UrlGenerator
     */
    protected $url;

    /**
     * Create a new ValidUrl instance.
     *
     * @param UrlGenerator $url
     */
    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    /**
     * Handle the validation.
     *
     * @param        $value
     * @param Router $router
     * @return bool
     */
    public function handle($value, Router $router)
    {

        /**
         * Check if it's a
         * route and use that.
         */
        if ($router->has($value)) {
            return true;
        }

        /**
         * If it matches now
         * then we're done here.
         */
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return true;
        }

        /**
         * Otherwise try adding
         * a protocol and make
         * sure it's got a ".".
         */
        if (strpos($value, '.') && filter_var('http://' . $value, FILTER_VALIDATE_URL)) {
            return true;
        }

        /**
         * Just try making it
         * a URL and test that.
         */
        if (filter_var($this->url->to($value), FILTER_VALIDATE_URL)) {
            return true;
        }

        /**
         * Also check if it's a
         * hash value which is OK.
         */
        if (starts_with($value, '#')) {
            return true;
        }

        return false;
    }
}
