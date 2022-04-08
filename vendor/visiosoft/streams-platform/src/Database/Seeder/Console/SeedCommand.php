<?php namespace Anomaly\Streams\Platform\Database\Seeder\Console;

use Anomaly\Streams\Platform\Database\Seeder\Console\Command\SetAddonSeederClass;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class SeedCommand
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SeedCommand extends \Illuminate\Database\Console\Seeds\SeedCommand
{

    use DispatchesJobs;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->dispatchNow(
            new SetAddonSeederClass(
                $this,
                $this->input
            )
        );

        $path = $this->input->getOption('class');

        if ($path && !class_exists($path)) {

            $this->info('Nothing to seed.');

            return;
        }

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
                ['addon', null, InputOption::VALUE_OPTIONAL, 'The addon to seed.'],
            ]
        );
    }
}
