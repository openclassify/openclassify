<?php namespace Anomaly\Streams\Platform\Database\Migration\Console;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class RefreshCommand
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RefreshCommand extends \Illuminate\Database\Console\Migrations\RefreshCommand
{

    use DispatchesJobs;

    /**
     * Execute the console command.
     * This is an exact copy of the base command
     * except that it includes the --addon option.
     *
     * @return void
     */
    public function handle()
    {
        if (!$this->confirmToProceed()) {
            return;
        }

        $path     = $this->input->getOption('path');
        $addon    = $this->input->getOption('addon');
        $force    = $this->input->getOption('force');
        $database = $this->input->getOption('database');

        // If the "step" option is specified it means we only want to rollback a small
        // number of migrations before migrating again. For example, the user might
        // only rollback and remigrate the latest four migrations instead of all.
        $step = $this->input->getOption('step', $addon) ?: 0;

        if ($step > 0) {
            $this->call(
                'migrate:rollback',
                [
                    '--database' => $database,
                    '--addon'    => $addon,
                    '--force'    => $force,
                    '--step'     => $step,
                ]
            );
        } else {
            $this->call(
                'migrate:reset',
                [
                    '--database' => $database,
                    '--addon'    => $addon,
                    '--force'    => $force,
                ]
            );
        }

        // The refresh command is essentially just a brief aggregate of a few other of
        // the migration commands and just provides a convenient wrapper to execute
        // them in succession. We'll also see if we need to re-seed the database.
        $this->call(
            'migrate',
            [
                '--database' => $database,
                '--addon'    => $addon,
                '--force'    => $force,
                '--path'     => $path,
            ]
        );

        if ($this->needsSeeding()) {
            $this->runSeeder($database);
        }
    }

    /**
     * Get the command options.
     *
     * @return array
     */
    public function getOptions()
    {
        return array_merge(
            parent::getOptions(),
            [
                ['addon', null, InputOption::VALUE_OPTIONAL, 'The addon to reset migrations.'],
            ]
        );
    }
}
