<?php namespace Anomaly\Streams\Platform\Ui\Tree\Component\Segment;

use Anomaly\Streams\Platform\Routing\UrlGenerator;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\SectionCollection;
use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;
use Illuminate\Http\Request;

/**
 * Class SegmentDefaults
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SegmentDefaults
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
     * Create a new SegmentDefaults instance.
     *
     * @param UrlGenerator      $url
     * @param Request           $request
     * @param SectionCollection $sections
     */
    public function __construct(UrlGenerator $url, Request $request, SectionCollection $sections)
    {
        $this->url      = $url;
        $this->request  = $request;
        $this->sections = $sections;
    }

    /**
     * Handle default segments.
     *
     * @param TreeBuilder $builder
     */
    public function defaults(TreeBuilder $builder)
    {
        if ($builder->getSegments()) {
            return;
        }

        if (!$section = $this->sections->active()) {
            return;
        }

        $builder->setSegments(
            [
                [
                    'wrapper' => '<a href="' . $section->getHref('edit') . '/{entry.id}">{value}</a>',
                    'value'   => 'entry.title',
                ],
            ]
        );
    }
}
