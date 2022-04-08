<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\View;

use Anomaly\Streams\Platform\Traits\FiresCallbacks;
use Anomaly\Streams\Platform\Ui\Table\Component\View\Contract\ViewInterface;
use Closure;

/**
 * Class View
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class View implements ViewInterface
{

    use FiresCallbacks;

    /**
     * The view slug.
     *
     * @var null|string
     */
    protected $slug = null;

    /**
     * The view text.
     *
     * @var null|string
     */
    protected $text = null;

    /**
     * The view icon.
     *
     * @var null|string
     */
    protected $icon = null;

    /**
     * The view label.
     *
     * @var string
     */
    protected $label;

    /**
     * The active flag.
     *
     * @var bool
     */
    protected $active = false;

    /**
     * The view prefix.
     *
     * @var string
     */
    protected $prefix = null;

    /**
     * The view context.
     *
     * @var string
     */
    protected $context = 'danger';

    /**
     * The attributes array.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * The view filters.
     *
     * @var null
     */
    protected $filters = null;

    /**
     * The view columns.
     *
     * @var null
     */
    protected $columns = null;

    /**
     * The view buttons.
     *
     * @var null
     */
    protected $buttons = null;

    /**
     * The view actions.
     *
     * @var null
     */
    protected $actions = null;

    /**
     * The view options.
     *
     * @var null
     */
    protected $options = null;

    /**
     * The view handler.
     *
     * @var callable|null|string
     */
    protected $handler = null;

    /**
     * The view query.
     *
     * @var null|string|Closure
     */
    protected $query = null;

    /**
     * The view entries.
     *
     * @var null|mixed
     */
    protected $entries = null;

    /**
     * Get the label.
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set the label.
     *
     * @param  string $label
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get the context.
     *
     * @return boolean
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Set the context flag.
     *
     * @param  boolean $active
     * @return $this
     */
    public function setContext($context)
    {
        $this->context = $context;

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
     * @param  array $attributes
     * @return $this
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Get the view handler.
     *
     * @return callable|null|string
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * Set the view handler.
     *
     * @param $handler
     * @return $this
     */
    public function setHandler($handler)
    {
        $this->handler = $handler;

        return $this;
    }

    /**
     * Get the query.
     *
     * @return callable|null|string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Set the query.
     *
     * @param $query
     * @return $this
     */
    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Set the active flag.
     *
     * @param  bool $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;

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
     * Get the view prefix.
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set the view prefix.
     *
     * @param $prefix
     * @return $this
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get the view slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the view slug.
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
     * Get the view text.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the view text.
     *
     * @param  string $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

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
     * Get the filters.
     *
     * @return null|array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * Set the filters.
     *
     * @param $filters
     * @return $this
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;

        return $this;
    }

    /**
     * Get the columns.
     *
     * @return null|array
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Set the columns.
     *
     * @param $columns
     * @return $this
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * Get the buttons.
     *
     * @return null|array
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     * Set the buttons.
     *
     * @param $buttons
     * @return $this
     */
    public function setButtons($buttons)
    {
        $this->buttons = $buttons;

        return $this;
    }

    /**
     * Get the actions.
     *
     * @return null|array
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Set the actions.
     *
     * @param $actions
     * @return $this
     */
    public function setActions($actions)
    {
        $this->actions = $actions;

        return $this;
    }

    /**
     * Get the options.
     *
     * @return null|array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set the options.
     *
     * @param $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get the entries.
     *
     * @return null|array
     */
    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * Set the entries.
     *
     * @param $entries
     * @return $this
     */
    public function setEntries($entries)
    {
        $this->entries = $entries;

        return $this;
    }
}
