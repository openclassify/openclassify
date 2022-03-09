<?php

namespace Anomaly\Streams\Platform\Application\Console;

use Anomaly\Streams\Platform\Application\Command\ReadEnvironmentFile;
use Anomaly\Streams\Platform\Application\Command\WriteEnvironmentFile;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class EnvSet
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class EnvSet extends Command
{
    use DispatchesJobs;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'env:set';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set an environmental value.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $line = $this->argument('line');

        list($variable, $value) = explode('=', $line, 2);

        $contents = preg_replace("/{$variable}=.+/", "{$variable}=\"{$value}\"", file_get_contents(base_path('.env')));

        file_put_contents(base_path('.env'), $contents);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['line', InputArgument::REQUIRED, 'The line to update.'],
        ];
    }
}
