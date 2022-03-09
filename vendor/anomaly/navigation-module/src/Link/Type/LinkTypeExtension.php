<?php namespace Anomaly\NavigationModule\Link\Type;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\NavigationModule\Link\Type\Contract\LinkTypeInterface;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class LinkTypeExtension
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class LinkTypeExtension extends Extension implements LinkTypeInterface
{

    /**
     * Return the link URL.
     *
     * @param  LinkInterface $link
     * @return string
     */
    public function url(LinkInterface $link)
    {
        return null;
    }

    /**
     * Return the link title.
     *
     * @param  LinkInterface $link
     * @return string
     */
    public function title(LinkInterface $link)
    {
        return null;
    }

    /**
     * Return if the link exists or not.
     *
     * @param  LinkInterface $link
     * @return bool
     */
    public function exists(LinkInterface $link)
    {
        return true;
    }

    /**
     * Return if the link is enabled or not.
     *
     * @param  LinkInterface $link
     * @return bool
     */
    public function enabled(LinkInterface $link)
    {
        return true;
    }

    /**
     * Return the form builder for
     * the link type entry.
     *
     * @return FormBuilder
     */
    public function builder()
    {
        return null;
    }
}
