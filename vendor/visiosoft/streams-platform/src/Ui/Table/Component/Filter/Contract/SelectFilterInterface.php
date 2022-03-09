<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract;

/**
 * Interface SelectFilterInterface
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
interface SelectFilterInterface extends FilterInterface
{

    /**
     * Set the options.
     *
     * @param  array $options
     * @return mixed
     */
    public function setOptions($options);

    /**
     * Get the options.
     *
     * @return mixed
     */
    public function getOptions();
}
