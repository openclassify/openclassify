<?php namespace Anomaly\Streams\Platform\Addon\Console;

use Anomaly\Streams\Platform\Addon\AddonLoader;
use Anomaly\Streams\Platform\Addon\AddonManager;
use Anomaly\Streams\Platform\Addon\Console\Command\MakeAddonPaths;
use Anomaly\Streams\Platform\Addon\Console\Command\ScaffoldTheme;
use Anomaly\Streams\Platform\Addon\Console\Command\WriteAddonButtonLang;
use Anomaly\Streams\Platform\Addon\Console\Command\WriteAddonClass;
use Anomaly\Streams\Platform\Addon\Console\Command\WriteAddonComposer;
use Anomaly\Streams\Platform\Addon\Console\Command\WriteAddonFeatureTest;
use Anomaly\Streams\Platform\Addon\Console\Command\WriteAddonFieldLang;
use Anomaly\Streams\Platform\Addon\Console\Command\WriteAddonGitIgnore;
use Anomaly\Streams\Platform\Addon\Console\Command\WriteAddonLang;
use Anomaly\Streams\Platform\Addon\Console\Command\WriteAddonPackage;
use Anomaly\Streams\Platform\Addon\Console\Command\WriteAddonPermissionLang;
use Anomaly\Streams\Platform\Addon\Console\Command\WriteAddonPermissions;
use Anomaly\Streams\Platform\Addon\Console\Command\WriteAddonPhpUnit;
use Anomaly\Streams\Platform\Addon\Console\Command\WriteAddonSectionLang;
use Anomaly\Streams\Platform\Addon\Console\Command\WriteAddonServiceProvider;
use Anomaly\Streams\Platform\Addon\Console\Command\WriteAddonStreamLang;
use Anomaly\Streams\Platform\Addon\Console\Command\WriteAddonWebpack;
use Anomaly\Streams\Platform\Addon\Console\Command\WriteThemePackage;
use Anomaly\Streams\Platform\Addon\Console\Command\WriteThemeWebpack;
use Illuminate\Console\Command;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class MakeAddon
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class MakeAddon extends Command
{

    use DispatchesJobs;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:addon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new addon.';

    /**
     * Execute the console command.
     *
     * @param AddonManager $addons
     * @param AddonLoader $loader
     * @param Repository $config
     * @throws \Exception
     */
    public function handle(AddonManager $addons, AddonLoader $loader, Repository $config)
    {
        $namespace = $this->argument('namespace');

        if (preg_match('/^\w+\.[a-zA-Z_]+\.\w+\z/u', $namespace) !== 1) {
            throw new \Exception('The namespace should be snake case and formatted like: {vendor}.{type}.{slug}');
        }

        list($vendor, $type, $slug) = array_map(
            function ($value) {
                return str_slug(strtolower($value), '_');
            },
            explode('.', $namespace)
        );

        if (!in_array($type, $config->get('streams::addons.types'))) {
            throw new \Exception("The [{$type}] addon type is invalid.");
        }

        $type = str_singular($type);

        $path = $this->dispatchNow(new MakeAddonPaths($vendor, $type, $slug, $this));

        $this->dispatchNow(new WriteAddonLang($path, $type, $slug));
        $this->dispatchNow(new WriteAddonClass($path, $type, $slug, $vendor));
        $this->dispatchNow(new WriteAddonPhpUnit($path, $type, $slug, $vendor));
        $this->dispatchNow(new WriteAddonComposer($path, $type, $slug, $vendor));
        // @todo Autoloading issues...
        //$this->dispatchNow(new WriteAddonTestCase($path, $type, $slug, $vendor));
        $this->dispatchNow(new WriteAddonGitIgnore($path, $type, $slug, $vendor));
        $this->dispatchNow(new WriteAddonFeatureTest($path, $type, $slug, $vendor));
        $this->dispatchNow(new WriteAddonServiceProvider($path, $type, $slug, $vendor));

        $this->info("Addon [{$vendor}.{$type}.{$slug}] created.");

        $loader
            ->load($path)
            ->register()
            ->dump();

        $addons->register();

        /**
         * Create the initial migration file
         * for modules and extensions.
         */
        if (in_array($type, ['module', 'extension']) || $this->option('migration')) {
            $this->call(
                'make:migration',
                [
                    'name'     => 'create_' . $slug . '_fields',
                    '--addon'  => $namespace,
                    '--fields' => true,
                ]
            );
        }

        /**
         * Scaffold Modules and Extensions.
         */
        if (in_array($type, ['module', 'extension'])) {
            $this->dispatchNow(new WriteAddonFieldLang($path));
            $this->dispatchNow(new WriteAddonStreamLang($path));
            $this->dispatchNow(new WriteAddonPermissions($path));
            $this->dispatchNow(new WriteAddonPermissionLang($path));
        }

        /**
         * Scaffold Modules.
         */
        if ($type == 'module') {
            $this->dispatchNow(new WriteAddonButtonLang($path));
            $this->dispatchNow(new WriteAddonSectionLang($path));
        }

        /**
         * Scaffold themes.
         *
         * This moves in resources
         * and front-end tooling.
         */
        if ($type == 'theme') {
            $this->dispatchNow(new ScaffoldTheme($path));
            $this->dispatchNow(new WriteThemeWebpack($path));
            $this->dispatchNow(new WriteThemePackage($path));
        }

        /**
         * Scaffold non-themes.
         */
        if ($type !== 'theme') {
            $this->dispatchNow(new WriteAddonWebpack($path));
            $this->dispatchNow(new WriteAddonPackage($path));
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['namespace', InputArgument::REQUIRED, 'The addon\'s desired dot namespace.'],
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
            ['shared', null, InputOption::VALUE_NONE, 'Indicates if the addon should be created in shared addons.'],
            ['migration', null, InputOption::VALUE_NONE, 'Indicates if a fields migration should be created.'],
        ];
    }
}
