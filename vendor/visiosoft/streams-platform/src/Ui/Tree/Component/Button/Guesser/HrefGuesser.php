<?php namespace Anomaly\Streams\Platform\Ui\Tree\Component\Button\Guesser;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\SectionCollection;
use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;

/**
 * Class HrefGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class HrefGuesser
{

    /**
     * The URL generator.
     *
     * @var UrlGenerator
     */
    protected $url;

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * The section collection.
     *
     * @var SectionCollection
     */
    protected $sections;

    /**
     * Create a new HrefGuesser instance.
     *
     * @param UrlGenerator $url
     * @param Request $request
     * @param SectionCollection $sections
     */
    public function __construct(UrlGenerator $url, Request $request, SectionCollection $sections)
    {
        $this->url      = $url;
        $this->request  = $request;
        $this->sections = $sections;
    }

    /**
     * Guess the HREF for a button.
     *
     * @param TreeBuilder $builder
     */
    public function guess(TreeBuilder $builder)
    {
        $buttons = $builder->getButtons();

        // Nothing to do if empty.
        if (!$section = $this->sections->active()) {
            return;
        }

        foreach ($buttons as &$button) {

            // If we already have an HREF then skip it.
            if (isset($button['attributes']['href'])) {
                continue;
            }

            /**
             * If a route has been defined then
             * move that to an HREF closure.
             */
            if (isset($button['route']) && $builder->getTreeStream()) {

                $button['attributes']['href'] = function ($entry) use ($button) {

                    /* @var EntryInterface $entry */
                    return $entry->route($button['route']);
                };

                continue;
            }

            // Determine the HREF based on the button type.
            if ($type = array_get($button, 'segment', array_get($button, 'button'))) {
                $button['attributes']['href'] = $section->getHref($type . '/{entry.id}');
            }
        }

        $builder->setButtons($buttons);
    }
}
