<?php namespace Anomaly\UrlFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Routing\UrlGenerator;
use Anomaly\UrlFieldType\Validator\ValidUrl;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

/**
 * Class UrlFieldType
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UrlFieldType extends FieldType
{

    /**
     * The URL generator.
     *
     * @var UrlGenerator
     */
    protected $url;

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * The input class.
     *
     * @var string
     */
    protected $class = 'form-control';

    /**
     * The field type rules.
     *
     * @var array
     */
    protected $rules = [
        'valid_url',
    ];

    /**
     * The field type validators.
     *
     * @var array
     */
    protected $validators = [
        'valid_url' => [
            'handler' => ValidUrl::class,
            'message' => 'anomaly.field_type.url::message.invalid_url',
        ],
    ];

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'anomaly.field_type.url::input';

    /**
     * The router utility.
     *
     * @var Router
     */
    protected $router;

    /**
     * Create a new UrlFieldType instance.
     *
     * @param UrlGenerator $url
     * @param Router       $router
     * @param Request      $request
     */
    public function __construct(UrlGenerator $url, Router $router, Request $request)
    {
        $this->url     = $url;
        $this->router  = $router;
        $this->request = $request;
    }

    /**
     * Return the normalized URL.
     *
     * @return string|null
     */
    public function normalize()
    {
        if (!$value = $this->getValue()) {
            return null;
        }

        /**
         * If the value is a route
         * then let's use that
         * first and foremost.
         */
        if ($this->router->has($value)) {
            return $this->url->route($value);
        }

        /**
         * If it's already a URL
         * then we're done here.
         */
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }

        /**
         * Otherwise try adding
         * a protocol and test that.
         */
        if (filter_var('http://' . $value, FILTER_VALIDATE_URL) && str_contains($value, '.')) {
            return ($this->request->isSecure() ? 'https://' : 'http://') . $value;
        }

        /**
         * Lastly try making it
         * a URL and test that.
         */
        if (filter_var($this->url->to($value), FILTER_VALIDATE_URL)) {
            return $this->url->to($value);
        }

        return $value;
    }

}
