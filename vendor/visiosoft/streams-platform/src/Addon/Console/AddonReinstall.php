<?php namespace Anomaly\Streams\Platform\Addon\Console;

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class AddonReinstall
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddonReinstall extends Command
{

    use DispatchesJobs;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'addon:reinstall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reinstall an addon.';

    /**
     * Execute the console command.
     *
     * @param AddonCollection $addons
     */
    public function handle(AddonCollection $addons)
    {
        if (!$addon = $addons->get($this->argument('addon'))) {
            $this->error('The [' . $this->argument('addon') . '] could not be found.');
        }

        if ($addon instanceof Module) {

            $this->call('addon:uninstall', ['addon' => $this->argument('addon')]);
            $this->call('addon:install', ['addon' => $this->argument('addon'), '--seed' => $this->option('seed')]);
        }

        if ($addon instanceof Extension) {

            $this->call('addon:uninstall', ['addon' => $this->argument('addon')]);
            $this->call('addon:install', ['addon' => $this->argument('addon'), '--seed' => $this->option('seed')]);
        }
    }

    /**
     * Get the command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['addon', InputArgument::OPTIONAL, 'The addon to reinstall.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['seed', null, InputOption::VALUE_NONE, 'Seed the addon after installing?'],
        ];
    }
}
