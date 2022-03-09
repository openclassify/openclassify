<?php

namespace Anomaly\NavigationModule\Link;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Anomaly\Streams\Platform\Support\Decorator;

/**
 * Class LinkPresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class LinkPresenter extends EntryPresenter
{

    /**
     * The decorated object.
     * This is for IDE hinting.
     *
     * @var LinkInterface
     */
    protected $object;

    /**
     * Return the edit link.
     *
     * @return string
     */
    public function editLink()
    {
        return app('html')->link(
            implode(
                '/',
                array_filter(
                    [
                        'admin',
                        $this->object->getStreamNamespace(),
                        $this->object->getStreamSlug(),
                        $this->object->getMenuSlug(),
                        'edit',
                        $this->object->getId(),
                    ]
                )
            ),
            $this->object->getTitle()
        );
    }

    /**
     * Return the related children.
     *
     * @return LinkCollection
     */
    public function children()
    {
        return (new Decorator())->decorate($this->object->getChildren());
    }

    /**
     * Return the string output.
     *
     * @return string
     */
    public function __toString()
    {
        $classes = explode(' ', $this->object->getClass());

        if ($this->object->isActive()) {
            $classes[] = 'active';
        }

        if ($this->object->isCurrent()) {
            $classes[] = 'current';
        }

        return (string) app('html')->link(
            $this->object->getUrl(),
            $this->object->getTitle(),
            [
                'class'  => implode(' ', array_filter($classes)),
                'target' => $this->object->getTarget()
            ]
        );
    }
}
