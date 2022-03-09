<?php

namespace Anomaly\Streams\Platform\Http\Middleware;

use Anomaly\Streams\Platform\Message\MessageBag;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;
use Illuminate\Session\Store;
use Jenssegers\Agent\Agent;

/**
 * Class HttpCache
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class HttpCache
{

    /**
     * System excluded.
     *
     * @var array
     */
    protected $excluded = [
        '/admin',
        '/admin/*',
        '/streams/*-field_type/*',
        '/streams/*-extension/*',
        '/streams/*-module/*',
        '/entry/handle/*',
        '/form/handle/*',
        '/locks/touch',
        '/locks/release',
        '/logout*',
        '/login*',
    ];

    /**
     * The agent utility.
     *
     * @var Agent
     */
    protected $agent;

    /**
     * The session store.
     *
     * @var Store
     */
    protected $session;

    /**
     * The message bag.
     *
     * @var MessageBag
     */
    protected $messages;

    /**
     * Create a new PoweredBy instance.
     *
     * @param Agent $agent
     * @param Store $session
     * @param MessageBag $messages
     */
    public function __construct(Agent $agent, Store $session, MessageBag $messages)
    {
        $this->agent    = $agent;
        $this->session  = $session;
        $this->messages = $messages;
    }

    /**
     * Handle the command.
     *
     * @param  Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /* @var Response $response */
        $response = $next($request);

        /* @var Route $route */
        $route = $request->route();

        /**
         * Don't cache the admin.
         * And skip the rest.
         */
        if ($request->segment(1) == 'admin') {
            return $response->setTtl(0);
        }

        /**
         * Don't cache if redirect is desired.
         */
        if ($response instanceof RedirectResponse) {
            return $response->setTtl(0);
        }

        /**
         * Don't cache if the route
         * is dictating 0 ttl.
         */
        if ($route->getAction('ttl') === 0) {
            return $response->setTtl(0);
        }

        /**
         * Don't cache if HTTP cache
         * is disabled in the route.
         */
        if ($route->getAction('httpcache') === false) {
            return $response->setTtl(0);
        }

        /**
         * Same thing.. no need for prefixing.
         * @deprecated in 1.6 removing in 1.7
         */
        if ($route->getAction('streams::httpcache') === false) {
            return $response->setTtl(0);
        }

        /**
         * Don't cache if HTTP cache
         * is disabled in the system.
         */
        if (config('streams::httpcache.enabled', false) === false) {
            return $response->setTtl(0);
        }

        /**
         * Don't let BOTs generate cache files.
         */
        if (config('streams::httpcache.allow_bots', false) === false && $this->agent->isRobot()) {
            return $response->setTtl(0);
        }

        /**
         * Don't cache if we have session indicators!
         *
         * This could happen if a form attempts caching
         * directly after a bad submit / failed validation.
         */
        if (
            $this->session->get('_flash.new') ||
            $this->session->get('_flash.old') ||
            $this->messages->has('info') ||
            $this->messages->has('error') ||
            $this->messages->has('success') ||
            $this->messages->has('warning')
        ) {
            $response->setTtl(0);
        }

        /**
         * Determine the default TTL value.
         */
        $default = $route->getAction('ttl') ?: config('streams::httpcache.ttl', 3600);

        /**
         * Exclude these paths from caching
         * based on partial / exact URI.
         */
        $excluded = config('streams::httpcache.excluded', []);

        if (is_string($excluded)) {
            $excluded = array_map(
                function ($line) {
                    return trim($line);
                },
                explode("\n", $excluded)
            );
        }

        // Merge system excluded routes.
        $excluded = array_merge((array) $excluded, $this->excluded);

        foreach ($excluded as $path) {
            if (str_is($path, $request->getPathInfo())) {
                $response->setTtl(0);
            }
        }

        /**
         * Define timeout rules based on
         * partial / exact URI matching.
         */
        $rules = config('streams::httpcache.rules', []);

        if (is_string($rules)) {
            $rules = array_map(
                function ($line) {
                    return trim($line);
                },
                explode("\n", $rules)
            );
        }

        foreach ((array) $rules as $rule) {

            $parts = explode(' ', $rule);

            $path = array_shift($parts);
            $ttl  = array_shift($parts);

            if ($ttl === null) {
                $ttl = $default;
            }

            if (str_is($path, $request->getPathInfo())) {
                $response->setTtl($ttl);
            }
        }

        /**
         * Set the TTL based on the original TTL or the route
         * action OR the config and lastly a default value.
         */
        if ($response->getTtl() === null) {
            $response->setTtl($default);
        }

        /**
         * If the response has a TTL then
         * let's flush the flash messages.
         */
        if ($response->getTtl()) {
            $this->messages->flush();
        }

        return $response;
    }
}
