<?php namespace Anomaly\NavigationModule\Link\Command;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Anomaly\NavigationModule\Link\LinkCollection;
use Anomaly\NavigationModule\Link\Contract\LinkInterface;

/**
 * Class SetCurrentLink
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SetCurrentLink
{

    /**
     * The link collection.
     *
     * @var LinkCollection
     */
    protected $links;

    /**
     * Create a new SetCurrentLink instance.
     *
     * @param LinkCollection $links
     */
    public function __construct(LinkCollection $links)
    {
        $this->links = $links;
    }

    /**
     * Handle the command.
     *
     * @param Request $request
     */
    public function handle(Request $request)
    {
        $current = null;

        /*
         * If the route does not exist,
         * i.e. a 404 or 500 handling page.
         * Then we don't have anything to do.
         */
        if (!$route = $request->route()) {
            return;
        };

        $compiled     = $route->getCompiled();
        $staticPrefix = $compiled->getStaticPrefix();

        $host    = $request->getHost();
        $exact   = $request->fullUrl();
        $partial = $request->getUriForPath($staticPrefix);

        $path = array_get(parse_url($partial), 'path');

        /* @var LinkInterface $link */
        foreach ($this->links as $link) {

            if ($link->getUrl() == $exact) {
                $current = $link;
            } elseif ($link->getUrl() == $partial) {
                $current = $link;
            } elseif ($host == $link->host() && $link->path() == $path) {
                $current = $link;
            }


            /*
             * If the request URL does not even
             * contain the HREF then skip it.
             */
            if (!Str::contains($exact, $link->getUrl())) {
                continue;
            }

            /**
             * Home page will partial match
             * anything so don't include it.
             */
            if ($link->getUrl() === url('/')) {
                continue;
            }

            /*
             * Compare the length of the active HREF
             * and loop iteration HREF. The longer the
             * HREF the more detailed and exact it is and
             * the more likely it is the active HREF and
             * therefore the active section.
             */
            $hrefLength       = strlen($link->getUrl());
            $activeHrefLength = $current ? strlen($current->getUrl()) : '';

            if ($hrefLength > $activeHrefLength) {
                $current = $link;
            }
        }

        /**
         * If we have an current link determined
         * then mark it as such.
         *
         * @var LinkInterface $current
         */
        if ($current) {

            $current->setCurrent(true);

            /**
             * Just in case there are
             * multiple links that match
             * let's let things continue.
             *
             * For example:
             *
             * /example/link#section1
             * /example/link#section2
             */
            $current = null;
        }
    }
}
