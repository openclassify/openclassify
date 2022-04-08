<?php namespace Anomaly\PagesModule\Page;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Anomaly\Streams\Platform\Support\Decorator;

/**
 * Class PagePresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PagePresenter extends EntryPresenter
{

    /**
     * The decorated object.
     * This is for IDE hinting.
     *
     * @var PageInterface
     */
    protected $object;

    /**
     * Create a new PagePresenter instance.
     *
     * @param mixed $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }

    /**
     * Return the user's status as a label.
     *
     * @param  string      $size
     * @return null|string
     */
    public function statusLabel($size = 'sm')
    {
        $color  = 'default';
        $status = $this->status();

        switch ($status) {
            case 'scheduled':
                $color = 'info';
                break;

            case 'draft':
                $color = 'default';
                break;

            case 'live':
                $color = 'success';
                break;
        }

        return '<span class="tag tag-' . $size . ' tag-' . $color . '">' . trans(
                'anomaly.module.pages::field.status.option.' . $status
            ) . '</span>';
    }

    /**
     * Return the status key.
     *
     * @return null|string
     */
    public function status()
    {
        if (!$this->object->isEnabled()) {
            return 'draft';
        }

        if ($this->object->isEnabled() && !$this->object->isLive()) {
            return 'scheduled';
        }

        if ($this->object->isEnabled() && $this->object->isLive()) {
            return 'live';
        }

        return null;
    }

    /**
     * Catch calls to fields on
     * the page's related entry.
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($key)
    {
        $entry = $this->object->getEntry();

        if ($entry && $entry->hasField($key)) {
            return (New Decorator())->decorate($entry)->{$key};
        }

        return parent::__get($key);
    }
}
