<?php namespace Anomaly\Streams\Platform\Console;

/**
 * Class Kernel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Kernel extends \Illuminate\Foundation\Console\Kernel
{

    /**
     * Get the Artisan application instance.
     *
     * @return \Illuminate\Console\Application
     */
    protected function getArtisan()
    {
        if (is_null($this->artisan)) {
            return $this->artisan = (new Application(
                $this->app,
                $this->events,
                $this->app->version()
            ))->resolveCommands($this->commands);
        }

        return $this->artisan;
    }

    /**
     * Include base commands.
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
