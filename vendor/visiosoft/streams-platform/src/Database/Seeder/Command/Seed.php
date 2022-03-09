<?php namespace Anomaly\Streams\Platform\Database\Seeder\Command;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Support\Presenter;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Console\Command;

class Seed
{

    /**
     * The seeder class to run.
     *
     * @var null
     */
    protected $class;

    /**
     * The addon namespace.
     *
     * @var string
     */
    protected $addon;

    /**
     * The console command.
     *
     * @var Command
     */
    protected $command;

    /**
     * Create a new Seed instance.
     *
     * @param         $addon
     * @param null    $class
     * @param Command $consoleCommand
     */
    public function __construct($addon, $class = null, Command $command = null)
    {
        $this->addon   = $addon;
        $this->class   = $class;
        $this->command = $command;
    }

    /**
     * Handle the command.
     *
     * @param AddonCollection $addons
     * @param Seeder          $seeder
     */
    public function handle(AddonCollection $addons, Seeder $seeder)
    {
        $seeder->setContainer(app());
        $seeder->setCommand($command->getCommand());

        Model::unguard();

        $class = $command->getClass();
        $addon = $addons->get($command->getAddon());

        /*
         * Depending on when this is called, and
         * how seeding uses the view layer the addon's
         * could be decorated, so un-decorate them real
         * quick before proceeding.
         */
        if ($addon && $addon instanceof Presenter) {
            $addon = $addon->getObject();
        }

        /*
         * If the addon was passed then
         * get it and seed it.
         */
        if ($addon) {
            if (class_exists($this->getSeederClass($addon))) {
                $seeder->call($this->getSeederClass($addon));
            }
        }

        /*
         * If a seeder class was passed then
         * call it from the seeder utility.
         */
        if (!$addon && $class) {
            if (class_exists($class)) {
                $seeder->call($class);
            }
        }
    }

    /**
     * Get the seeder class for an addon.
     *
     * @param  Addon  $addon
     * @return string
     */
    protected function getSeederClass(Addon $addon)
    {
        return get_class($addon) . 'Seeder';
    }
}
