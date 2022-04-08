<?php namespace Anomaly\Streams\Platform\Database\Seeder\Console\Command;

use Anomaly\Streams\Platform\Addon\Command\GetAddon;
use Anomaly\Streams\Platform\Support\Decorator;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\InputInterface;

class SetAddonSeederClass
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
     * Create a new SetAddonPath instance.
     *
     * @param Command $command
     * @param InputInterface $input
     */
    public function __construct(Command $command, InputInterface $input)
    {
        $this->input   = $input;
        $this->command = $command;
    }

    /**
     * Handle the command.
     *
     * @param Decorator $decorator
     * @throws \Exception
     */
    public function handle(Decorator $decorator)
    {
        if (!$identifier = $this->input->getOption('addon')) {
            return;
        }

        if (!$addon = $this->dispatch(new GetAddon($identifier))) {
            throw new \Exception("[$identifier] addon could not be found.");
        }

        $addon = $decorator->undecorate($addon);

        $this->input->setOption('class', get_class($addon) . 'Seeder');
    }
}
