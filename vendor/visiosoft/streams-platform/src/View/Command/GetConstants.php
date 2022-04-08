<?php namespace Anomaly\Streams\Platform\View\Command;

use Illuminate\Contracts\View\Factory;

/**
 * Class GetConstants
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetConstants
{

    /**
     * Handle the command.
     *
     * @param  Factory                         $view
     * @return \Illuminate\Contracts\View\View
     */
    public function handle(Factory $view)
    {
        return $view->make('streams::partials/constants');
    }
}
