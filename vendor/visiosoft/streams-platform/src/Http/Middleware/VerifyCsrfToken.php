<?php namespace Anomaly\Streams\Platform\Http\Middleware;

use Anomaly\Streams\Platform\Message\MessageBag;
use Closure;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Foundation\Application;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Session\TokenMismatchException;

/**
 * Class VerifyCsrfToken
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class VerifyCsrfToken extends \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken
{
    /**
     * The route instance.
     *
     * @var Route
     */
    protected $route;

    /**
     * The message bar.
     *
     * @var MessageBag
     */
    protected $messages;

    /**
     * The redirector utility.
     *
     * @var Redirector
     */
    protected $redirector;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @param  \Illuminate\Contracts\Encryption\Encrypter $encrypter
     * @param MessageBag $messages
     * @param Redirector $redirector
     */
    public function __construct(
        Route $route,
        Application $app,
        Encrypter $encrypter,
        MessageBag $messages,
        Redirector $redirector
    ) {
        parent::__construct($app, $encrypter);

        $this->except = config('streams::security.csrf.except', []);
        $this->route      = $route;
        $this->messages   = $messages;
        $this->redirector = $redirector;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     *
     * @throws \Illuminate\Session\TokenMismatchException
     */
    public function handle($request, Closure $next)
    {
        if ($this->shouldPassThrough()) {
            return $this->addCookieToResponse($request, $next($request));
        }

        try {
            return parent::handle($request, $next);
        } catch (TokenMismatchException $exception) {
            $this->messages->error('streams::message.csrf_token_mismatch');
        }

        return $this->redirector->back(302);
    }

    /**
     * If the route disabled the
     * CSRF then we can skip it.
     *
     * @return bool
     */
    public function shouldPassThrough()
    {
        if (array_get($this->route->getAction(), 'csrf') === false) {
            return true;
        }

        return false;
    }
}
