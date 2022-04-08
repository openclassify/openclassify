<?php namespace Anomaly\Streams\Platform\Database\Migration\Console\Command;

use Anomaly\Streams\Platform\Addon\Command\GetAddon;
use Anomaly\Streams\Platform\Database\Migration\Migrator;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class ConfigureMigrator
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ConfigureMigrator
{

    use DispatchesJobs;

    /**
     * The input service.
     *
     * @var InputInterface
     */
    protected $input;

    /**
     * The console command.
     *
     * @var Command
     */
    protected $command;

    /**
     * The migrator service.
     *
     * @var Migrator
     */
    protected $migrator;

    /**
     * Create a new SetAddonPath instance.
     *
     * @param Command        $command
     * @param InputInterface $input
     * @param Migrator       $migrator
     */
    public function __construct(Command $command, InputInterface $input, Migrator $migrator)
    {
        $this->input    = $input;
        $this->command  = $command;
        $this->migrator = $migrator;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        if (!$addon = $this->input->getOption('addon')) {

            $this->migrator->clearAddon();

            return;
        }

        if (!$addon = $this->dispatchNow(new GetAddon($addon))) {
            throw new \Exception("Addon could not be found.");
        }

        $this->migrator->setAddon($addon);

        $paths = [
            $addon->getPath('migrations'),
            $this->command->getLaravel()->databasePath()
            . DIRECTORY_SEPARATOR.'migrations'
            . DIRECTORY_SEPARATOR.$addon->getNamespace(),
        ];

        $this->input->setOption('path', $paths);
        $this->input->setOption('realpath', true);
    }
}
