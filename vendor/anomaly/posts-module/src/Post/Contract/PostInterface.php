<?php namespace Anomaly\PostsModule\Post\Contract;

use Anomaly\PostsModule\Category\Contract\CategoryInterface;
use Anomaly\PostsModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface PostInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface PostInterface extends EntryInterface
{

    /**
     * Make the post.
     *
     * @return $this
     */
    public function make();

    /**
     * Return the post content.
     *
     * @return null|string
     */
    public function content();

    /**
     * Get the string ID.
     *
     * @return string
     */
    public function getStrId();

    /**
     * Get the tags.
     *
     * @return array
     */
    public function getTags();

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Get the type.
     *
     * @return null|TypeInterface
     */
    public function getType();

    /**
     * Get the type name.
     *
     * @return string
     */
    public function getTypeName();

    /**
     * Get the type slug.
     *
     * @return string
     */
    public function getTypeSlug();

    /**
     * Get the type description.
     *
     * @return string
     */
    public function getTypeDescription();

    /**
     * Get the category.
     *
     * @return null|CategoryInterface
     */
    public function getCategory();

    /**
     * Get the category slug.
     *
     * @return null|string
     */
    public function getCategorySlug();

    /**
     * Get the related entry.
     *
     * @return EntryInterface
     */
    public function getEntry();

    /**
     * Get the related entry's ID.
     *
     * @return null|int
     */
    public function getEntryId();

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
     * Return the publish at date.
     *
     * @return Carbon
     */
    public function getPublishAt();

    /**
     * Alias for getPublishAt()
     *
     * @return Carbon
     */
    public function getDate();

    /**
     * Return if the post is live or not.
     *
     * @return bool
     */
    public function isLive();

    /**
     * Get the enabled flag.
     *
     * @return bool
     */
    public function isEnabled();

    /**
     * Get the path to the post's type layout.
     *
     * @return string
     */
    public function getLayoutViewPath();

    /**
     * Get the content.
     *
     * @return null|string
     */
    public function getContent();

    /**
     * Set the content.
     *
     * @param $content
     * @return $this
     */
    public function setContent($content);

    /**
     * Get the response.
     *
     * @return Response|null
     */
    public function getResponse();

    /**
     * Set the response.
     *
     * @param $response
     * @return $this
     */
    public function setResponse(Response $response);
}
