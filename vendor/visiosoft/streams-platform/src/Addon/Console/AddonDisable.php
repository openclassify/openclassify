<?php namespace Anomaly\Streams\Platform\Addon\Console;

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionManager;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Addon\Module\ModuleManager;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\InputArgument;

class AddonDisable extends Command
{
    use DispatchesJobs;

    protected $name = 'addon:disable';

    protected $description = 'Disable an addon.';

    public function handle(AddonCollection $addons, ModuleManager $modules, ExtensionManager $extensions)
    {
        if (!$addon = $addons->get($this->argument('addon'))) {
            $this->error('The [' . $this->argument('addon') . '] could not be found.');
        }

        if ($addon instanceof Module) {

            $modules->disable($addon);

            $this->info('The [' . $this->argument('addon') . '] module was disabled.');
        }

        if ($addon instanceof Extension) {

            $extensions->disable($addon);

            $this->info('The [' . $this->argument('addon') . '] extension was disabled.');
        }
    }

    protected function getArguments()
    {
        return [
            ['addon', InputArgument::REQUIRED, 'The addon to install.'],
        ];
    }
}
