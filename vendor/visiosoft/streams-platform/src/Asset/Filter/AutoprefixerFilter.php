<?php namespace Anomaly\Streams\Platform\Asset\Filter;

/**
 * Class AutoprefixerFilter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AutoprefixerFilter extends \Assetic\Filter\AutoprefixerFilter
{

    /**
     * Create a new AutoprefixerFilter instance.
     */
    public function __construct()
    {
        parent::__construct(config('streams::assets.autoprefixer', null));
    }

}
