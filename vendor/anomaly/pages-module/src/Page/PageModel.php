<?php namespace Anomaly\PagesModule\Page;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\PagesModule\Page\Handler\Contract\PageHandlerInterface;
use Anomaly\PagesModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\EloquentCollection;
use Anomaly\Streams\Platform\Model\Pages\PagesPagesEntryModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PageModel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PageModel extends PagesPagesEntryModel implements PageInterface
{

    /**
     * The versionable flag.
     *
     * @var bool
     */
    protected $versionable = true;

    /**
     * Always eager load these.
     *
     * @var array
     */
    protected $with = [
        'type',
        'entry',
        'translations',
        'allowedRoles',
    ];

    /**
     * The cascaded relations.
     *
     * @var array
     */
    protected $cascades = [
        'children',
        'entry',
    ];

    /**
     * The active flag.
     *
     * @var bool
     */
    protected $active = false;

    /**
     * The current flag.
     *
     * @var bool
     */
    protected $current = false;

    /**
     * The page's content.
     *
     * @var null|string
     */
    protected $content = null;

    /**
     * The page's response.
     *
     * @var null|Response
     */
    protected $response = null;

    /**
     * Sort the query.
     *
     * @param Builder $builder
     * @param string $direction
     */
    public function scopeSorted(Builder $builder, $direction = 'asc')
    {
        $builder->orderBy('parent_id', $direction)->orderBy('sort_order', $direction);
    }

    /**
     * Restrict to live posts only.
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeLive(Builder $query)
    {
        return $query
            ->fresh()
            ->where('enabled', 1)
            ->where(
                function (Builder $query) {
                    $query->where(
                        'publish_at',
                        '<=',
                        (new Carbon(null, config('streams::datetime.default_timezone')))
                            ->setTimezone(config('streams::datetime.database_timezone'))
                            ->format('Y-m-d H:i:s')
                    )
                        ->orWhereNull('publish_at');
                }
            );
    }

    /**
     * Make the page.
     *
     * @return $this
     */
    public function make()
    {
        $handler = $this->getHandler();

        $handler->make($this);

        return $this;
    }

    /**
     * Return the page content.
     *
     * @return null|string
     */
    public function content()
    {
        return $this
            ->make()
            ->getContent();
    }

    /**
     * Get the path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Get the string ID.
     *
     * @return string
     */
    public function getStrId()
    {
        return $this->str_id;
    }

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the meta title.
     *
     * @return string
     */
    public function getMetaTitle()
    {
        if (!$this->meta_title) {
            return $this->getTitle();
        }

        return $this->meta_title;
    }

    /**
     * Get the meta description.
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->meta_description;
    }

    /**
     * Return if schedule is due.
     *
     * @return bool
     */
    public function isPublished()
    {
        return !($this->getPublishAt()->diff(now(config('app.timezone')))->invert);
    }

    /**
     * Get the exact flag.
     *
     * @return bool
     */
    public function isExact()
    {
        return $this->exact;
    }

    /**
     * Get the live flag.
     *
     * @return bool
     */
    public function isLive()
    {
        return $this->isEnabled() && $this->isPublished();
    }

    /**
     * Get the enabled flag.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Get the visible flag.
     *
     * @return bool
     */
    public function isVisible()
    {
        return $this->getFieldValue('visible');
    }

    /**
     * Get the home flag.
     *
     * @return bool
     */
    public function isHome()
    {
        return $this->home;
    }

    /**
     * Get the related parent page.
     *
     * @return null|PageInterface
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Get the parent ID.
     *
     * @return int|null
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * Get the related children pages.
     *
     * @return PageCollection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Get the related sibling pages.
     *
     * @return PageCollection
     */
    public function getSiblings()
    {
        return $this->siblings;
    }

    /**
     * Return the publish at date.
     *
     * @return Carbon
     */
    public function getPublishAt()
    {
        return $this->publish_at ?: now();
    }

    /**
     * Get the related roles allowed.
     *
     * @return EloquentCollection
     */
    public function getAllowedRoles()
    {
        return $this->allowed_roles;
    }

    /**
     * Get the route suffix.
     *
     * @param  null $prefix
     * @return null|string
     */
    public function getRouteSuffix($prefix = null)
    {
        return $this->route_suffix ? $prefix . $this->route_suffix : null;
    }

    /**
     * Get the page type.
     *
     * @return null|TypeInterface
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the page handler.
     *
     * @return PageHandlerInterface
     */
    public function getHandler()
    {
        $type = $this->getType();

        return $type->getHandler();
    }

    /**
     * Get the theme layout.
     *
     * @return string
     */
    public function getThemeLayout()
    {
        return $this->theme_layout;
    }

    /**
     * Get the related entry.
     *
     * @return null|EntryInterface
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * Get the related entry ID.
     *
     * @return null|int
     */
    public function getEntryId()
    {
        return $this->entry_id;
    }

    /**
     * Get the content.
     *
     * @return null|string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the content.
     *
     * @param $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the response.
     *
     * @return Response|null
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set the response.
     *
     * @param $response
     * @return $this
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Get the current flag.
     *
     * @return bool
     */
    public function isCurrent()
    {
        return $this->current;
    }

    /**
     * Set the current flag.
     *
     * @param $current
     * @return $this
     */
    public function setCurrent($current)
    {
        $this->current = $current;

        return $this;
    }

    /**
     * Get the active flag.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Set the active flag.
     *
     * @param $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get the route name.
     *
     * @return string
     */
    public function getRouteName()
    {
        return $this->route_name;
    }

    /**
     * Return the children relationship.
     *
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany('Anomaly\PagesModule\Page\PageModel', 'parent_id', 'id')
            ->orderBy('sort_order', 'ASC');
    }

    /**
     * Return the siblings relationship.
     *
     * @return HasMany
     */
    public function siblings()
    {
        return $this->hasMany('Anomaly\PagesModule\Page\PageModel', 'parent_id', 'parent_id')
            ->orderBy('sort_order', 'ASC');
    }

    /**
     * Return the searchable array.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        if (!$this->isLive()) {
            return [];
        }

        $array = parent::toSearchableArray();

        if ($entry = $this->getEntry()) {
            $array = array_filter(array_merge($entry->toSearchableArray(), $array));
        }

        $array['title'] = array_get($array, 'meta_title', array_get($array, 'title'));
        $array['description'] = array_get($array, 'meta_description', array_get($array, 'description'));

        return $array;
    }

}
