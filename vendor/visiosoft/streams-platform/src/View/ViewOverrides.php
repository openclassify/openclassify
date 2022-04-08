<?php namespace Anomaly\Streams\Platform\View;

use Illuminate\Support\Collection;

/**
 * Class ViewOverrides
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ViewOverrides extends Collection
{

    public function put($key, $value)
    {

        /**
         * Force the key and value to use
         * dot notation for view names.
         */
        return parent::put(str_replace('/', '.', $key), str_replace('/', '.', $value));
    }

}
