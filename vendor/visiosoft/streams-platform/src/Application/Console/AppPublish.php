<?php namespace Anomaly\Streams\Platform\Application\Console;

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\InputOption;
use Anomaly\Streams\Platform\Application\Console\Command\PublishEnv;
use Anomaly\Streams\Platform\Application\Console\Command\PublishRoutes;

class AppPublish extends Command
{
    use DispatchesJobs;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'app:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish general application override files.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->dispatchNow(new PublishEnv($this));
        $this->dispatchNow(new PublishRoutes($this));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Force overwriting files.'],
        ];
    }
}
