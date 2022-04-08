<?php namespace Anomaly\UsersModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\NavigationCollection;
use Illuminate\Routing\Redirector;

/**
 * Class HomeController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class HomeController extends AdminController
{

    /**
     * Redirect to the users home page.
     *
     * @param  NavigationCollection $navigation
     * @param  Redirector           $redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(NavigationCollection $navigation, Redirector $redirect)
    {
        $home = $navigation->first();

        return $redirect->to($home->getHref());
    }
}
