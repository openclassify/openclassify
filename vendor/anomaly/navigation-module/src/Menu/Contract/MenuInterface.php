<?php namespace Anomaly\NavigationModule\Menu\Contract;

use Anomaly\NavigationModule\Link\LinkCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Interface MenuInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface MenuInterface extends EntryInterface
{

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName();

    /**
     * Get the related links.
     *
     * @return LinkCollection
     */
    public function getLinks();

    /**
     * Return the links relation.
     *
     * @return HasMany
     */
    public function links();
}
