<?php namespace Anomaly\RedirectsModule\Http\Controller;

use Anomaly\RedirectsModule\Redirect\Contract\RedirectInterface;
use Anomaly\RedirectsModule\Redirect\Contract\RedirectRepositoryInterface;
use Anomaly\RedirectsModule\Redirect\RedirectResponse;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Illuminate\Routing\Route;

/**
 * Class RedirectsController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RedirectsController extends PublicController
{

    /**
     * Handle the redirect.
     *
     * @param  Route $route
     * @param  RedirectResponse $response
     * @param  RedirectRepositoryInterface $redirects
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Route $route, RedirectResponse $response, RedirectRepositoryInterface $redirects)
    {
        /* @var RedirectInterface $redirect */
        if (!$redirect = $redirects->find(array_get($route->getAction(), 'redirect'))) {
            abort(404);
        }

        return $response->create($redirect);
    }
}
