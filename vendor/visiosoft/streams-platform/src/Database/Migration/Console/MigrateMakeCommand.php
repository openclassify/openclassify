<?php namespace Anomaly\Streams\Platform\Database\Migration\Console;

use Anomaly\Streams\Platform\Database\Migration\Console\Command\ConfigureCreator;
use Anomaly\Streams\Platform\Database\Migration\MigrationCreator;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class MigrateMakeCommand
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class MigrateMakeCommand extends \Illuminate\Database\Console\Migrations\MigrateMakeCommand
{

    use DispatchesJobs;

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'make:migration {name : The name of the migration.}
        {--table= : The table to migrate.}
        {--create= : The table to be created.}
        {--fields : Create a fields migration.}
        {--addon= : The addon to create a migration for.}
        {--stream= : The stream to create a migration for.}
        {--path= : The location where the migration file should be created.}
        {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
        {--fullpath : Output the full path of the migration}';

    /**
     * The migration creator.
     *
     * @var MigrationCreator
     */
    protected $creator;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->dispatchNow(
            new ConfigureCreator(
                $this,
                $this->input,
                $this->creator
            )
        );

        $this->creator->setInput($this->input);

        parent::handle();
    }
}
