<?php namespace Anomaly\Streams\Platform\Artisan;

use Anomaly\Streams\Platform\Database\Migration\Console\MigrateCommand;
use Anomaly\Streams\Platform\Database\Migration\Console\MigrateMakeCommand;
use Anomaly\Streams\Platform\Database\Migration\Console\RefreshCommand;
use Anomaly\Streams\Platform\Database\Migration\Console\ResetCommand;
use Anomaly\Streams\Platform\Database\Migration\Console\RollbackCommand;
use Anomaly\Streams\Platform\Database\Seeder\Console\SeedCommand;
use Illuminate\Contracts\Events\Dispatcher;

/**
 * Class StreamsConsoleProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ArtisanServiceProvider extends \Illuminate\Foundation\Providers\ArtisanServiceProvider
{

    /**
     * The commands to register.
     *
     * @var array
     */
    protected $streamsCommands = [

        // Cache Commands
        \Anomaly\Streams\Platform\Http\Console\Warm::class,

        // Asset Commands
        \Anomaly\Streams\Platform\Asset\Console\Clear::class,

        // Installer Commands
        \Anomaly\Streams\Platform\Installer\Console\Install::class,

        // Twig Commands
        \Anomaly\Streams\Platform\View\Twig\Console\TwigClear::class,

        // Streams Commands
        \Anomaly\Streams\Platform\Stream\Console\Make::class,
        \Anomaly\Streams\Platform\Stream\Console\Index::class,
        \Anomaly\Streams\Platform\Stream\Console\Compile::class,
        \Anomaly\Streams\Platform\Stream\Console\Cleanup::class,
        \Anomaly\Streams\Platform\Stream\Console\Destroy::class,

        // Addon Commands
        \Anomaly\Streams\Platform\Addon\Console\MakeAddon::class,
        \Anomaly\Streams\Platform\Addon\Console\AddonPublish::class,
        \Anomaly\Streams\Platform\Addon\Console\AddonInstall::class,
        \Anomaly\Streams\Platform\Addon\Console\AddonUninstall::class,
        \Anomaly\Streams\Platform\Addon\Console\AddonReinstall::class,
        \Anomaly\Streams\Platform\Addon\Console\AddonDisable::class,

        // Application Commands
        \Anomaly\Streams\Platform\Application\Console\Build::class,
        \Anomaly\Streams\Platform\Application\Console\EnvSet::class,
        \Anomaly\Streams\Platform\Application\Console\Refresh::class,
        \Anomaly\Streams\Platform\Application\Console\AppPublish::class,
        \Anomaly\Streams\Platform\Application\Console\StreamsPublish::class,
    ];

    /**
     * Register the given commands.
     *
     * @param  array $commands
     * @return void
     */
    protected function registerCommands(array $commands)
    {
        parent::registerCommands($commands);

        $this->commands(
            array_unique(
                array_merge(
                    $this->streamsCommands,
                    config('streams.commands', [])
                )
            )
        );
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerSeedCommand()
    {
        $this->app->singleton(
            'command.seed',
            function ($app) {
                return new SeedCommand($app['db']);
            }
        );
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMigrateCommand()
    {
        $this->app->singleton(
            'command.migrate',
            function ($app) {
                return new MigrateCommand($app['migrator'], $app[Dispatcher::class]);
            }
        );
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMigrateMakeCommand()
    {
        $this->app->singleton(
            'command.migrate.make',
            function ($app) {
                // Once we have the migration creator registered, we will create the command
                // and inject the creator. The creator is responsible for the actual file
                // creation of the migrations, and may be extended by these developers.
                $creator = $app['migration.creator'];

                $composer = $app['composer'];

                return new MigrateMakeCommand($creator, $composer);
            }
        );
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMigrateRefreshCommand()
    {
        $this->app->singleton(
            'command.migrate.refresh',
            function () {
                return new RefreshCommand();
            }
        );
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMigrateResetCommand()
    {
        $this->app->singleton(
            'command.migrate.reset',
            function ($app) {
                return new ResetCommand($app['migrator']);
            }
        );
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMigrateRollbackCommand()
    {
        $this->app->singleton(
            'command.migrate.rollback',
            function ($app) {
                return new RollbackCommand($app['migrator']);
            }
        );
    }
}
