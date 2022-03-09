<?php namespace Anomaly\Streams\Platform\Database\Migration\Console;

use Anomaly\Streams\Platform\Database\Migration\Console\Command\ConfigureMigrator;
use Anomaly\Streams\Platform\Database\Migration\Console\Command\MigrateAllAddons;
use Anomaly\Streams\Platform\Database\Migration\Console\Command\MigrateStreams;
use Anomaly\Streams\Platform\Database\Migration\Migrator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class MigrateCommand
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class MigrateCommand extends \Illuminate\Database\Console\Migrations\MigrateCommand
{

    use DispatchesJobs;

    /**
     * The custom migrator we use.
     *
     * @var Migrator
     */
    protected $migrator;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate {--database= : The database connection to use.}
                {--force : Force the operation to run when in production.}
                {--path= : The path of migrations files to be executed.}
                {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
                {--schema-path= : The path to a schema dump file}
                {--pretend : Dump the SQL queries that would be run.}
                {--seed : Indicates if the seed task should be re-run.}
                {--step : Force the migrations to be run so they can be rolled back individually.}
                {--addon= : The addon to migrate.}
                {--streams : Flag all streams core/application for migration.}
                {--all-addons : Flag all addons for migration.}';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->input->getOption('streams')) {
            return $this->dispatchNow(new MigrateStreams($this));
        }

        if ($this->input->getOption('all-addons')) {
            return $this->dispatchNow(new MigrateAllAddons($this));
        }

        $this->dispatchNow(
            new ConfigureMigrator(
                $this,
                $this->input,
                $this->migrator
            )
        );

        parent::handle();
    }

    /**
     * Get the options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array_merge(
            parent::getOptions(),
            [
                ['addon', null, InputOption::VALUE_OPTIONAL, 'The addon to migrate.'],
                ['streams', null, InputOption::VALUE_NONE, 'Flag all streams core/application for migration.'],
                ['all-addons', null, InputOption::VALUE_NONE, 'Flag all addons for migration.'],
            ]
        );
    }
}
