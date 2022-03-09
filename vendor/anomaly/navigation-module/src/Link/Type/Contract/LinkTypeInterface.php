<?php namespace Anomaly\NavigationModule\Link\Type\Contract;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Interface LinkTypeInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface LinkTypeInterface
{

    /**
     * Return the link URL.
     *
     * @param  LinkInterface $link
     * @return string
     */
    public function url(LinkInterface $link);

    /**
     * Return the link title.
     *
     * @param  LinkInterface $link
     * @return string
     */
    public function title(LinkInterface $link);

    /**
     * Return if the link exists or not.
     *
     * @param  LinkInterface $link
     * @return bool
     */
    public function exists(LinkInterface $link);

    /**
     * Return if the link is enabled or not.
     *
     * @param  LinkInterface $link
     * @return bool
     */
    public function enabled(LinkInterface $link);

    /**
     * Return the form builder for
     * the link type entry.
     *
     * @return FormBuilder
     */
    public function builder();
}
