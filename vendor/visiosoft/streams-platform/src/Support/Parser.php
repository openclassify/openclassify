<?php

namespace Anomaly\Streams\Platform\Support;

use StringTemplate\Engine;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Arrayable;
use Anomaly\Streams\Platform\Routing\UrlGenerator;

/**
 * Class Parser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Parser
{

    /**
     * The URL generator.
     *
     * @var UrlGenerator
     */
    protected $url;

    /**
     * The string parser.
     *
     * @var Engine
     */
    protected $parser;

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * Create a new Parser instance.
     *
     * @param UrlGenerator $url
     * @param Engine $parser
     * @param Request $request
     */
    public function __construct(UrlGenerator $url, Engine $parser, Request $request)
    {
        $this->url     = $url;
        $this->parser  = $parser;
        $this->request = $request;
    }

    /**
     * Parse data into the target recursively.
     *
     * @param        $target
     * @param  array $data
     * @return mixed
     */
    public function parse($target, array $data = [])
    {
        $data = $this->prepareData($data);

        /*
         * If the target is an array
         * then parse it recursively.
         */
        if (is_array($target)) {
            foreach ($target as $key => &$value) {
                $value = $this->parse($value, $data);
            }
        }

        /*
         * if the target is a string and is in a parsable
         * format then parse the target with the payload.
         */
        if (is_string($target) && Str::contains($target, ['{', '}'])) {
            $target = $this->parser->render($target, $data);
        }

        return $target;
    }

    /**
     * Prepare the data.
     *
     * @param  array $data
     * @return array
     */
    protected function prepareData(array $data)
    {
        return $this->toArray($this->mergeDefaultData($data));
    }

    /**
     * Merge default data.
     *
     * @param  array $data
     * @return array
     */
    protected function mergeDefaultData(array $data)
    {
        $url     = $this->urlData();
        $request = $this->requestData();

        return array_merge(compact('url', 'request'), $data);
    }

    /**
     * Prep data for parsing.
     *
     * @param  array $data
     * @return array
     */
    protected function toArray(array $data)
    {
        foreach ($data as $key => &$value) {
            if (is_object($value) && $value instanceof Arrayable) {
                $value = $value->toArray();
            }
        }

        return $data;
    }

    /**
     * Return the URL data.
     *
     * @return array
     */
    protected function urlData()
    {
        return [
            'previous' => $this->url->previous(),
        ];
    }

    /**
     * Return the request data.
     *
     * @return array
     */
    protected function requestData()
    {
        $request = [
            'url'      => $this->request->url(),
            'path'     => $this->request->path(),
            'root'     => $this->request->root(),
            'input'    => $this->request->input(),
            'full_url' => $this->request->fullUrl(),
            'segments' => $this->request->segments(),
            'uri'      => $this->request->getRequestUri(),
            'query'    => $this->request->getQueryString(),
        ];

        if ($route = $this->request->route()) {
            $request['route'] = [
                'uri'                      => $route->uri(),
                'parameters'               => $route->parameters(),
                'parameters.to_urlencoded' => array_map(
                    function ($parameter) {
                        return urlencode($parameter);
                    },
                    array_filter($route->parameters())
                ),
                'parameter_names'          => $route->parameterNames(),
                'compiled'                 => [
                    'static_prefix'     => $route->getCompiled()->getStaticPrefix(),
                    'parameters_suffix' => str_replace(
                        $route->getCompiled()->getStaticPrefix(),
                        '',
                        $this->request->getRequestUri()
                    ),
                ],
            ];
        }

        return $request;
    }
}
