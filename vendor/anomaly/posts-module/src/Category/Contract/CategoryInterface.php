<?php namespace Anomaly\PostsModule\Category\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Interface CategoryInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface CategoryInterface extends EntryInterface
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
     * Get the description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get the meta title.
     *
     * @return string
     */
    public function getMetaTitle();

    /**
     * Get the meta description.
     *
     * @return string
     */
    public function getMetaDescription();

    /**
     * Get the related posts.
     *
     * @return EntryCollection
     */
    public function getPosts();

    /**
     * Return the posts relation.
     *
     * @return HasMany
     */
    public function posts();
}
