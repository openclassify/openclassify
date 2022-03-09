<?php namespace Anomaly\Streams\Platform\Application;

use Anomaly\Streams\Platform\Application\Command\CreateApplication;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class ApplicationManager
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ApplicationManager
{
    use DispatchesJobs;

    /**
     * Create a new application.
     *
     * @param  array            $attributes
     * @return ApplicationModel
     */
    public function create(array $attributes)
    {
        return $this->dispatchNow(new CreateApplication($attributes));
    }
}
