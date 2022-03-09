<?php

namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\Command;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Anomaly\Streams\Platform\Support\Authorizer;
use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\Contract\NavigationLinkInterface;

/**
 * Class SetActiveNavigationLink
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetActiveNavigationLink
{

    /**
     * The control_panel builder.
     *
     * @var ControlPanelBuilder
     */
    protected $builder;

    /**
     * Create a new SetActiveNavigationLink instance.
     *
     * @param ControlPanelBuilder $builder
     */
    public function __construct(ControlPanelBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param Request              $request
     * @param Authorizer           $authorizer
     * @param BreadcrumbCollection $breadcrumbs
     */
    public function handle(Request $request, Authorizer $authorizer, BreadcrumbCollection $breadcrumbs)
    {
        $links = $this->builder->getControlPanelNavigation();

        /*
         * If we already have an active link
         * then we don't need to do this.
         */
        if ($active = $links->active()) {
            return;
        }

        /* @var NavigationLinkInterface $link */
        foreach ($links as $link) {

            /*
             * Get the HREF for both the active
             * and loop iteration link.
             */
            $href       = array_get($link->getAttributes(), 'href');
            $activeHref = '';

            if ($active && $active instanceof NavigationLinkInterface) {
                $activeHref = array_get($active->getAttributes(), 'href');
            }

            /*
             * If the request URL does not even
             * contain the HREF then skip it.
             */
            if (!Str::contains($request->url(), $href)) {
                continue;
            }

            /*
             * Compare the length of the active HREF
             * and loop iteration HREF. The longer the
             * HREF the more detailed and exact it is and
             * the more likely it is the active HREF and
             * therefore the active link.
             */
            $hrefLength       = strlen($href);
            $activeHrefLength = strlen($activeHref);

            if ($hrefLength > $activeHrefLength) {
                $active = $link;
            }
        }

        // No active link!
        if (!$active) {
            return;
        }

        // Active navigation link!
        $active->setActive(true);

        // Authorize the active link.
        if (!$authorizer->authorize($active->getPermission())) {
            abort(403);
        }

        // Add the bread crumb.
        if (($breadcrumb = $active->getBreadcrumb()) !== false) {
            $breadcrumbs->put($breadcrumb ?: $active->getTitle(), $active->getHref());
        }
    }
}
