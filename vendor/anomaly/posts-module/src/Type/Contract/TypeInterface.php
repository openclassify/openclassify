<?php namespace Anomaly\PostsModule\Type\Contract;

/*
 * Interface TypeInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\PostsModule\Type\Contract
 */
use Anomaly\PostsModule\Post\PostCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Interface TypeInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface TypeInterface extends EntryInterface
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
     * Get the related stream.
     *
     * @return StreamInterface
     */
    public function getEntryStream();

    /**
     * Get the related entry stream ID.
     *
     * @return integer
     */
    public function getEntryStreamId();

    /**
     * Get the related stream's
     * entry model name.
     *
     * @return string
     */
    public function getEntryModelName();

    /**
     * Get the theme layout.
     *
     * @return string
     */
    public function getThemeLayout();

    /**
     * Get related posts.
     *
     * @return PostCollection
     */
    public function getPosts();

    /**
     * Return the posts relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts();
}
