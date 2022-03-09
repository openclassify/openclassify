<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract;

/**
 * Interface InputFilterInterface
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
interface InputFilterInterface extends FilterInterface
{

    /**
     * Set the type.
     *
     * @param  $type
     * @return mixed
     */
    public function setType($type);

    /**
     * Get the type.
     *
     * @return mixed
     */
    public function getType();
}
