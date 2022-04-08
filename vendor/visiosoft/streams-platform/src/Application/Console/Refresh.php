<?php namespace Anomaly\Streams\Platform\Application\Console;

use Anomaly\Streams\Platform\Application\Event\SystemIsRefreshing;
use Anomaly\Streams\Platform\Console\Kernel;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

/**
 * Class Refresh
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Refresh extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the system.';

    /**
     * Execute the console command.
     */
    public function handle(Kernel $console, Filesystem $files)
    {

        $this->info('Refreshing system...');

        /**
         * Clear the various caches.
         */
        $console->call('httpcache:clear', []);

        $this->info('HTTP cache cleared.');

        $console->call('assets:clear', []);

        $this->info('Assets cache cleared.');

        $console->call('cache:clear', []);

        $this->info('Cache cleared.');

        $console->call('view:clear', []);
        $console->call('twig:clear', []);

        $this->info('View caches cleared.');

        /**
         * Restart utility services.
         */
        $console->call('queue:restart', [], $this->getOutput());

        /**
         * If the config is cached then
         * delete it and regenerate again.
         */
        if ($files->exists($config = base_path('bootstrap/cache/config.php'))) {

            $files->delete($config);

            $console->call('config:cache', [], $this->getOutput());
        }

        /**
         * If routes are cached then
         * delete them and regenerate.
         */
        if ($files->exists($routes = base_path('bootstrap/cache/routes.php'))) {

            $files->delete($routes);

            $console->call('route:cache', [], $this->getOutput());
        }

        // Clear packages cache.
        if ($files->exists($packages = base_path('bootstrap/cache/packages.php'))) {
            $files->delete($packages);
        }

        // Clear services cache.
        if ($files->exists($services = base_path('bootstrap/cache/services.php'))) {
            $files->delete($services);
        }

        event(new SystemIsRefreshing($this));
    }
}
