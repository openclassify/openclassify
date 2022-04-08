<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Header\Contract;

/**
 * Interface HeaderInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface HeaderInterface
{

    /**
     * Get the header heading.
     *
     * @return mixed
     */
    public function getHeading();

    /**
     * Set the header heading.
     *
     * @param $heading
     * @return $this
     */
    public function setHeading($heading);
}
