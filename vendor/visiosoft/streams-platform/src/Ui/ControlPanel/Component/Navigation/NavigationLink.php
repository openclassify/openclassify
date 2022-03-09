<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation;

use Anomaly\Streams\Platform\Asset\Asset;
use Anomaly\Streams\Platform\Image\Image;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\Contract\NavigationLinkInterface;
use Anomaly\Streams\Platform\Ui\Icon\Command\GetIcon;
use Anomaly\Streams\Platform\Ui\Icon\IconRegistry;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class NavigationLink
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class NavigationLink implements NavigationLinkInterface
{

    use DispatchesJobs;

    /**
     * The links slug.
     *
     * @var null|string
     */
    protected $slug = null;

    /**
     * The link icon.
     *
     * @var null|string
     */
    protected $icon = null;

    /**
     * The links title.
     *
     * @var null|string
     */
    protected $title = null;

    /**
     * The class.
     *
     * @var null|string
     */
    protected $class = null;

    /**
     * The active flag.
     *
     * @var bool
     */
    protected $active = false;

    /**
     * The favorite flag.
     *
     * @var bool
     */
    protected $favorite = false;

    /**
     * The links attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * The links permission.
     *
     * @var null|string
     */
    protected $permission = null;

    /**
     * The links breadcrumb.
     *
     * @var null|string
     */
    protected $breadcrumb = null;

    /**
     * @var Image
     */
    protected $image;

    /**
     * @var Asset
     */
    protected $asset;

    /**
     * Create a new NavigationLink instance.
     *
     * @param Image        $image
     * @param Asset        $asset
     * @param IconRegistry $icons
     */
    public function __construct(Image $image, Asset $asset)
    {
        $this->image = $image;
        $this->asset = $asset;
    }

    public function icon($default = 'fa fa-puzzle-piece')
    {
        $icon = $this->getIcon() ?: $default;

        if (ends_with($icon, '.svg')) {
            return $this->image->make($icon)->data();
        }

        return $this->dispatchNow(new GetIcon($icon));
    }

    /**
     * Get the slug.
     *
     * @return null|string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the slug.
     *
     * @param $slug
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get the icon.
     *
     * @return null|string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set the icon.
     *
     * @param $icon
     * @return $this
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get the title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the title.
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get the class.
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set the class.
     *
     * @param $class
     * @return $this
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get the active flag.
     *
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Set the active flag.
     *
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get the favorite flag.
     *
     * @return boolean
     */
    public function isFavorite()
    {
        return $this->favorite;
    }

    /**
     * Set the favorite flag.
     *
     * @param boolean $favorite
     */
    public function setFavorite($favorite)
    {
        $this->favorite = $favorite;

        return $this;
    }

    /**
     * Get the attributes.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Set the attributes.
     *
     * @param array $attributes
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Get the permission.
     *
     * @return null|string
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * Set the permission.
     *
     * @param $permission
     * @return $this
     */
    public function setPermission($permission)
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * Get the breadcrumb.
     *
     * @return null|string
     */
    public function getBreadcrumb()
    {
        return $this->breadcrumb;
    }

    /**
     * Set the breadcrumb.
     *
     * @param $breadcrumb
     * @return $this
     */
    public function setBreadcrumb($breadcrumb)
    {
        $this->breadcrumb = $breadcrumb;

        return $this;
    }

    /**
     * Get the HREF attribute.
     *
     * @param  null $path
     * @return string
     */
    public function getHref($path = null)
    {
        return array_get($this->attributes, 'href') . ($path ? '/' . $path : $path);
    }
}
