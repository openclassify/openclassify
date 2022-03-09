<?php namespace Anomaly\Streams\Platform\Http\Controller;

use Anomaly\Streams\Platform\Asset\Asset;
use Anomaly\Streams\Platform\Event\Response;
use Anomaly\Streams\Platform\Http\Middleware\ApplicationReady;
use Anomaly\Streams\Platform\Http\Middleware\CheckLocale;
use Anomaly\Streams\Platform\Http\Middleware\ForceSsl;
use Anomaly\Streams\Platform\Http\Middleware\HttpCache;
use Anomaly\Streams\Platform\Http\Middleware\MiddlewareCollection;
use Anomaly\Streams\Platform\Http\Middleware\PoweredBy;
use Anomaly\Streams\Platform\Http\Middleware\PrefixDomain;
use Anomaly\Streams\Platform\Http\Middleware\SetLocale;
use Anomaly\Streams\Platform\Http\Middleware\VerifyCsrfToken;
use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\Streams\Platform\Routing\UrlGenerator;
use Anomaly\Streams\Platform\Traits\FiresCallbacks;
use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;
use Anomaly\Streams\Platform\View\ViewTemplate;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;

/**
 * Class BaseController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BaseController extends Controller
{

    use DispatchesJobs;
    use FiresCallbacks;

    /**
     * The service container.
     *
     * @var Container
     */
    protected $container;

    /**
     * The URL generator.
     *
     * @var UrlGenerator
     */
    protected $url;

    /**
     * The view factory.
     *
     * @var Factory
     */
    protected $view;

    /**
     * The asset manager.
     *
     * @var Asset
     */
    protected $asset;

    /**
     * The route object.
     *
     * @var Route
     */
    protected $route;

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * The flash messages.
     *
     * @var MessageBag
     */
    protected $messages;

    /**
     * The redirect utility.
     *
     * @var Redirector
     */
    protected $redirect;

    /**
     * The view template.
     *
     * @var ViewTemplate
     */
    protected $template;

    /**
     * The response factory.
     *
     * @var ResponseFactory
     */
    protected $response;

    /**
     * The breadcrumb collection.
     *
     * @var BreadcrumbCollection
     */
    protected $breadcrumbs;

    /**
     * Create a new BaseController instance.
     */
    public function __construct()
    {
        $this->container   = app(); // @deprecated in 1.7 remove in 1.8
        $this->request     = app('Illuminate\Http\Request'); // @deprecated in 1.7 remove in 1.8
        $this->redirect    = app('Illuminate\Routing\Redirector'); // @deprecated in 1.7 remove in 1.8
        $this->view        = app('Illuminate\Contracts\View\Factory'); // @deprecated in 1.7 remove in 1.8
        $this->asset       = app('Anomaly\Streams\Platform\Asset\Asset');
        $this->events      = app('Illuminate\Contracts\Events\Dispatcher'); // @deprecated in 1.7 remove in 1.8
        $this->template    = app('Anomaly\Streams\Platform\View\ViewTemplate');
        $this->messages    = app('Anomaly\Streams\Platform\Message\MessageBag');
        $this->response    = app('Illuminate\Contracts\Routing\ResponseFactory'); // @deprecated in 1.7 remove in 1.8
        $this->url         = app('Anomaly\Streams\Platform\Routing\UrlGenerator'); // @deprecated in 1.7 remove in 1.8
        $this->breadcrumbs = app('Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection');

        $this->route = $this->request->route();

        event(new Response($this));

        $this->middleware(PoweredBy::class);

        $this->middleware(VerifyCsrfToken::class);

        $this->middleware(ForceSsl::class);
        $this->middleware(PrefixDomain::class);

        $this->middleware(SetLocale::class);
        $this->middleware(CheckLocale::class);
        $this->middleware(ApplicationReady::class);

        foreach (app(MiddlewareCollection::class) as $middleware) {
            $this->middleware($middleware);
        }

        $this->middleware(HttpCache::class);
    }

    /**
     * Disable a middleware.
     *
     * @param $middleware
     * @return $this
     */
    protected function disableMiddleware($middleware)
    {
        foreach ($this->middleware as $key => $item) {
            if ($item['middleware'] == $middleware) {

                unset($this->middleware[$key]);

                return $this;
            }
        }

        return $this;
    }
}
