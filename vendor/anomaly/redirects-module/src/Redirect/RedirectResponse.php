<?php namespace Anomaly\RedirectsModule\Redirect;

use Anomaly\RedirectsModule\Redirect\Contract\RedirectInterface;
use Anomaly\Streams\Platform\Support\Parser;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;

/**
 * Class RedirectResponse
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class RedirectResponse
{

    /**
     * The URL generator.
     *
     * @var UrlGenerator
     */
    protected $url;

    /**
     * The route instance.
     *
     * @var Route
     */
    protected $route;

    /**
     * The parser utility.
     *
     * @var Parser
     */
    protected $parser;

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * The redirector utility.
     *
     * @var Redirector
     */
    protected $redirector;

    /**
     * Create a new RedirectResponse instance.
     *
     * @param UrlGenerator $url
     * @param Route        $route
     * @param Parser       $parser
     * @param Request      $request
     * @param Redirector   $redirector
     */
    function __construct(UrlGenerator $url, Route $route, Parser $parser, Request $request, Redirector $redirector)
    {
        $this->url        = $url;
        $this->route      = $route;
        $this->parser     = $parser;
        $this->request    = $request;
        $this->redirector = $redirector;
    }

    /**
     * Create a new Redirect response.
     *
     * @param  RedirectInterface $redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(RedirectInterface $redirect)
    {
        $parameters = array_merge(
            array_map(
                function () {
                    return null;
                },
                array_flip($this->route->parameterNames())
            ),
            $this->route->parameters()
        );

        if (!starts_with($url = $redirect->getTo(), ['http://', 'https://', '//'])) {
            $url = $this->url->to($url);
        }

        $parsed = parse_url(
            preg_replace_callback(
                "/\{[a-z]+\?\}/",
                function ($matches) {
                    return str_replace('?', '!', $matches[0]);
                },
                $url
            )
        );

        $parsed['path'] = preg_replace_callback(
            "/\{[a-z]+\!\}/",
            function ($matches) {
                return str_replace('!', '', $matches[0]);
            },
            array_get($parsed, 'path')
        );

        $variables = get_defined_vars();

        array_set(
            $parsed,
            'path',
            $this->parser->parse(
                array_get($parsed, 'path', ''),
                array_get($variables, 'parameters', [])
            )
        );

        array_set(
            $parsed,
            'host',
            $this->parser->parse(
                array_get($parsed, 'host', ''),
                array_get($variables, 'parameters', [])
            )
        );

        array_set(
            $parsed,
            'query',
            $this->parser->parse(
                array_get($parsed, 'query', '')
            )
        );

        parse_str($parsed['query'], $parsed['query']);
        parse_str($this->request->getQueryString(), $query);

        $parsed['query'] = http_build_query(array_merge($parsed['query'], $query));

        if (!isset($parsed['host'])) {
            $parsed['host'] = $this->request->getHost();
        }

        if (!isset($parsed['port']) && !in_array($this->request->getPort(), ['443', '80'])) {
            $parsed['port'] = $this->request->getPort();
        }

        if (!isset($parsed['scheme'])) {
            $parsed['scheme'] = $redirect->isSecure() ? 'https' : 'http';
        }

        if (isset($parsed['path']) && !starts_with($parsed['path'], '/')) {
            $parsed['path'] = '/' . $parsed['path'];
        }

        $url = (($scheme = array_get($parsed, 'scheme')) ? "{$scheme}:" : '') .
            ((isset($parsed['user']) || isset($parsed['host'])) ? '//' : '') .
            (($user = array_get($parsed, 'user')) ? "{$user}" : '') .
            (($pass = array_get($parsed, 'pass')) ? ":{$pass}" : '') .
            (($user = array_get($parsed, 'user')) ? '@' : '') .
            (($host = array_get($parsed, 'host')) ? "{$host}" : '') .
            (($port = array_get($parsed, 'port')) ? ":{$port}" : '') .
            (($path = array_get($parsed, 'path')) ? "{$path}" : '') .
            (($query = array_get($parsed, 'query')) ? "?{$query}" : '') .
            (($fragment = array_get($parsed, 'fragment')) ? "#{$fragment}" : '');

        return $this->redirector->to(
            rtrim($this->parser->parse($url, $parameters), '/'),
            $redirect->getStatus()
        );
    }
}
