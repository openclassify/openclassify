<?php

namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\Command;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Anomaly\Streams\Platform\Support\Parser;
use Anomaly\Streams\Platform\Support\Authorizer;
use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\Contract\SectionInterface;

/**
 * Class SetActiveSection
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetActiveSection
{

    /**
     * The control_panel builder.
     *
     * @var ControlPanelBuilder
     */
    protected $builder;

    /**
     * Create a new SetActiveSection instance.
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
    public function handle(Parser $parser, Request $request, Authorizer $authorizer, BreadcrumbCollection $breadcrumbs)
    {
        $controlPanel = $this->builder->getControlPanel();
        $sections     = $controlPanel->getSections();

        /*
         * If we already have an active section
         * then we don't need to do this.
         */
        if ($active = $sections->active()) {
            return;
        }

        /* @var SectionInterface $section */
        foreach ($sections as $section) {

            if (($matcher = $section->getMatcher()) && str_is($matcher, $request->path())) {
                $active = $section;
            }

            /*
             * Get the HREF for both the active
             * and loop iteration section.
             */
            $href       = $parser->parse($section->getPermalink() ?: array_get($section->getAttributes(), 'href'));
            $activeHref = '';

            if ($active && $active instanceof SectionInterface) {
                $activeHref = $active->getPermalink() ?: array_get($active->getAttributes(), 'href');
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
             * therefore the active section.
             */
            $hrefLength       = strlen($href);
            $activeHrefLength = strlen($activeHref);

            if ($hrefLength > $activeHrefLength) {
                $active = $section;
            }
        }

        /**
         * If we have an active section determined
         * then mark it as such.
         *
         * @var SectionInterface $active
         * @var SectionInterface $section
         */
        if ($active) {
            if ($active->getParent()) {
                $active->setActive(true);

                $section = $sections->get($active->getParent(), $sections->first());

                $section->setHighlighted(true);

                $breadcrumbs->put($section->getBreadcrumb() ?: $section->getTitle(), $section->getHref());
            } else {
                $active->setActive(true)->setHighlighted(true);
            }
        } elseif ($active = $sections->first()) {
            $active->setActive(true)->setHighlighted(true);
        }

        // No active section!
        if (!$active) {
            return;
        }

        // Authorize the active section.
        if (!$authorizer->authorize($active->getPermission())) {
            abort(403);
        }

        // Add the bread crumb.
        if (($breadcrumb = $active->getBreadcrumb()) !== false) {
            $breadcrumbs->put($breadcrumb ?: $active->getTitle(), $active->getHref());
        }
    }
}
