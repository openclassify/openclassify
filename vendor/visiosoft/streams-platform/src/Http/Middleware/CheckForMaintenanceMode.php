<?php

namespace Anomaly\Streams\Platform\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\MaintenanceModeBypassCookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Auth\Guard;
use Symfony\Component\HttpFoundation\IpUtils;
use Anomaly\Streams\Platform\Support\Authorizer;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\Streams\Platform\Application\Application;
use Illuminate\Contracts\Foundation\Application as Laravel;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class CheckForMaintenanceMode
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CheckForMaintenanceMode
{

    /**
     * The application instance.
     *
     * @var Laravel
     */
    protected $app;

    /**
     * The URIs that should be accessible while maintenance mode is enabled.
     *
     * @var array
     */
    protected $except = [];

    /**
     * The auth guard.
     *
     * @var Guard
     */
    protected $guard;

    /**
     * The permission authorizer.
     *
     * @var Authorizer
     */
    protected $authorizer;

    /**
     * The application instance.
     *
     * @var Application
     */
    protected $application;

    /**
     * Create a new CheckForMaintenanceMode instance.
     *
     * @param Laravel $app
     * @param Guard $guard
     * @param Authorizer $authorizer
     * @param Application $application
     */
    public function __construct(
        Laravel $app,
        Guard $guard,
        Authorizer $authorizer,
        Application $application
    ) {
        $this->app         = $app;
        $this->guard       = $guard;
        $this->authorizer  = $authorizer;
        $this->application = $application;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return void|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$this->application->isEnabled()) {
            abort(503);
        }

        if (
            !$this->app->isDownForMaintenance() &&
            !config('streams::maintenance.enabled', false)
        ) {
            return $next($request);
        }

        if ($request->segment(1) == 'admin' || str_is('form/handle/*', $request->path())) {
            return $next($request);
        }

        if (in_array($request->getClientIp(), config('streams::maintenance.ip_whitelist', []))) {
            return $next($request);
        }

        /* @var UserInterface $user */
        $user = $this->guard->user();

        if ($user && $user->isAdmin()) {
            return $next($request);
        }

        if ($user && $this->authorizer->authorize('streams::maintenance.access')) {
            return $next($request);
        }

        if (!$user && config('streams::maintenance.auth')) {

            /* @var Response|null $response */
            $response = $this->guard->onceBasic();

            if (!$response) {
                return $next($request);
            }

            $response->setContent(view('streams::errors.401'));

            return $response;
        }

        $data = json_decode(file_get_contents($this->app->storagePath().'/framework/down'), true);

        if (isset($data['secret']) && $request->path() === $data['secret']) {
            return $this->bypassResponse($data['secret']);
        }

        if ($this->hasValidBypassCookie($request, $data) ||
            $this->inExceptArray($request)) {
            return $next($request);
        }

        if (isset($data['redirect'])) {
            $path = $data['redirect'] === '/'
                ? $data['redirect']
                : trim($data['redirect'], '/');

            if ($request->path() !== $path) {
                return redirect($path);
            }
        }

        if (isset($data['template'])) {
            return response(
                $data['template'],
                $data['status'] ?? 503,
                $this->getHeaders($data)
            );
        }

        throw new HttpException(
            $data['status'] ?? 503,
            'Service Unavailable',
            null,
            $this->getHeaders($data)
        );
    }

    /**
     * Determine if the incoming request has a maintenance mode bypass cookie.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $data
     * @return bool
     */
    protected function hasValidBypassCookie($request, array $data)
    {
        return isset($data['secret']) &&
            $request->cookie('laravel_maintenance') &&
            MaintenanceModeBypassCookie::isValid(
                $request->cookie('laravel_maintenance'),
                $data['secret']
            );
    }

    /**
     * Determine if the request has a URI that should be accessible in maintenance mode.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function inExceptArray($request)
    {
        foreach ($this->except as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->fullUrlIs($except) || $request->is($except)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Redirect the user back to the root of the application with a maintenance mode bypass cookie.
     *
     * @param  string  $secret
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function bypassResponse(string $secret)
    {
        return redirect('/')->withCookie(
            MaintenanceModeBypassCookie::create($secret)
        );
    }

    /**
     * Get the headers that should be sent with the response.
     *
     * @param  array  $data
     * @return array
     */
    protected function getHeaders($data)
    {
        $headers = isset($data['retry']) ? ['Retry-After' => $data['retry']] : [];

        if (isset($data['refresh'])) {
            $headers['Refresh'] = $data['refresh'];
        }

        return $headers;
    }

    /**
     * Get the URIs that should be accessible even when maintenance mode is enabled.
     *
     * @return array
     */
    public function getExcludedPaths()
    {
        return $this->except;
    }
}
