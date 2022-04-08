<?php namespace Anomaly\NavigationModule\Link\Command;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\NavigationModule\Link\LinkCollection;
use Anomaly\Streams\Platform\Routing\UrlGenerator;


/**
 * Class GetParentLink
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetParentLink
{

    /**
     * The root path.
     *
     * @var string
     */
    private $root;

    /**
     * The link collection.
     *
     * @var LinkCollection
     */
    protected $links;

    /**
     * Create a new GetParentLink instance.
     *
     * @param string         $root
     * @param LinkCollection $links
     */
    public function __construct($root, LinkCollection $links)
    {
        $this->root  = $root;
        $this->links = $links;
    }

    /**
     * Handle the command.
     *
     * @param  UrlGenerator       $url
     * @return LinkInterface|null
     */
    public function handle(UrlGenerator $url)
    {
        /* @var LinkInterface $link */
        foreach ($this->links as $link) {
            if ($url->to($this->root) == $link->getUrl()) {
                return $link;
            }
        }

        return null;
    }
}
