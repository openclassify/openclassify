<?php namespace Anomaly\Streams\Platform\Addon\Console;

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionManager;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Addon\Module\ModuleManager;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class AddonInstall
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddonInstall extends Command
{

    use DispatchesJobs;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'addon:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install an addon.';

    /**
     * Execute the console command.
     *
     * @param AddonCollection  $addons
     * @param ModuleManager    $modules
     * @param ExtensionManager $extensions
     */
    public function handle(AddonCollection $addons, ModuleManager $modules, ExtensionManager $extensions)
    {
        if (!$addon = $addons->get($this->argument('addon'))) {
            $this->error('The [' . $this->argument('addon') . '] could not be found.');
        }

        if ($addon instanceof Module) {

            $modules->install($addon, $this->option('seed'));

            $this->info('The [' . $this->argument('addon') . '] module was installed.');
        }

        if ($addon instanceof Extension) {

            $extensions->install($addon, $this->option('seed'));

            $this->info('The [' . $this->argument('addon') . '] extension was installed.');
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
            ['addon', InputArgument::REQUIRED, 'The addon to install.'],
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
