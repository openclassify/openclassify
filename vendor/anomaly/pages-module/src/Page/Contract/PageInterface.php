<?php namespace Anomaly\PagesModule\Page\Contract;

use Anomaly\PagesModule\Page\Handler\Contract\PageHandlerInterface;
use Anomaly\PagesModule\Page\PageCollection;
use Anomaly\PagesModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\EloquentCollection;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface PageInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface PageInterface extends EntryInterface
{

    /**
     * Make the page.
     *
     * @return $this
     */
    public function make();

    /**
     * Return the page content.
     *
     * @return null|string
     */
    public function content();

    /**
     * Get the path.
     *
     * @return string
     */
    public function getPath();

    /**
     * Get the string ID.
     *
     * @return string
     */
    public function getStrId();

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Get the title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Get the current flag.
     *
     * @return bool
     */
    public function isCurrent();

    /**
     * Set the current flag.
     *
     * @param $current
     * @return $this
     */
    public function setCurrent($current);

    /**
     * Get the active flag.
     *
     * @return bool
     */
    public function isActive();

    /**
     * Set the active flag.
     *
     * @param $active
     * @return $this
     */
    public function setActive($active);

    /**
     * Get the route name.
     *
     * @return string
     */
    public function getRouteName();

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
     * Return if schedule is met.
     *
     * @return bool
     */
    public function isPublished();

    /**
     * Get the exact flag.
     *
     * @return bool
     */
    public function isExact();

    /**
     * Get the live flag.
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
     * Get the visible flag.
     *
     * @return bool
     */
    public function isVisible();

    /**
     * Get the home flag.
     *
     * @return bool
     */
    public function isHome();

    /**
     * Get the related parent page.
     *
     * @return null|PageInterface
     */
    public function getParent();

    /**
     * Get the parent ID.
     *
     * @return null|int
     */
    public function getParentId();

    /**
     * Get the related children pages.
     *
     * @return PageCollection
     */
    public function getChildren();

    /**
     * Get the related sibling pages.
     *
     * @return PageCollection
     */
    public function getSiblings();

    /**
     * Return the publish at date.
     *
     * @return Carbon
     */
    public function getPublishAt();

    /**
     * Get the related roles allowed.
     *
     * @return EloquentCollection
     */
    public function getAllowedRoles();

    /**
     * Get the related page type.
     *
     * @return null|TypeInterface
     */
    public function getType();

    /**
     * Get the page handler.
     *
     * @return PageHandlerInterface
     */
    public function getHandler();

    /**
     * Get the theme layout.
     *
     * @return string
     */
    public function getThemeLayout();

    /**
     * Get the related entry.
     *
     * @return null|EntryInterface
     */
    public function getEntry();

    /**
     * Get the related entry ID.
     *
     * @return null|int
     */
    public function getEntryId();

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

    /**
     * Return the children relationship.
     *
     * @return HasMany
     */
    public function children();

    /**
     * Return the siblings relationship.
     *
     * @return HasMany
     */
    public function siblings();

}
