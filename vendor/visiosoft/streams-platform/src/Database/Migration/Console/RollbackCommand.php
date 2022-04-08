<?php namespace Anomaly\Streams\Platform\Database\Migration\Console;

use Anomaly\Streams\Platform\Database\Migration\Console\Command\ConfigureMigrator;
use Anomaly\Streams\Platform\Database\Migration\Migrator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class RollbackCommand
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RollbackCommand extends \Illuminate\Database\Console\Migrations\RollbackCommand
{

    use DispatchesJobs;

    /**
     * The migrator utility.
     *
     * @var Migrator
     */
    protected $migrator;

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
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
     * Get the command options.
     *
     * @return array
     */
    public function getOptions()
    {
        return array_merge(
            parent::getOptions(),
            [
                ['addon', null, InputOption::VALUE_OPTIONAL, 'The addon to rollback for.'],
            ]
        );
    }
}
