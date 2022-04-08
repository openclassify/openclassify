<?php namespace Anomaly\Streams\Platform\Ui\Tree\Component\Item\Contract;

/**
 * Interface ItemInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface ItemInterface
{

    /**
     * Get the ID.
     *
     * @return int
     */
    public function getId();

    /**
     * Get the parent ID.
     *
     * @return int
     */
    public function getParent();
}
