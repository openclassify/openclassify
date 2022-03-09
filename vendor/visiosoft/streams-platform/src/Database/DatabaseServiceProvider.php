<?php namespace Anomaly\Streams\Platform\Database;

use Anomaly\Streams\Platform\Database\Migration\MigrationServiceProvider;
use Illuminate\Support\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->register('Anomaly\Streams\Platform\Database\Seeder\SeederServiceProvider');
        $this->app->register(MigrationServiceProvider::class);
    }
}
