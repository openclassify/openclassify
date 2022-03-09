<?php namespace Anomaly\Streams\Platform\Database\Migration;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Database\Migration\Command\Migrate;
use Anomaly\Streams\Platform\Database\Migration\Command\Reset;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class Migrator
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Migrator extends \Illuminate\Database\Migrations\Migrator
{

    use DispatchesJobs;

    /**
     * The addon instance.
     *
     * @var Addon
     */
    protected $addon = null;

    /**
     * The migration repository.
     *
     * @var MigrationRepository
     */
    protected $repository;

    /**
     * Run the migrations.
     *
     * @param array $paths
     * @param array $options
     * @return array
     */
    public function run($paths = [], array $options = [])
    {
        $this->repository->setMigrator($this);

        return parent::run($paths, $options);
    }

    /**
     * Rolls all of the currently applied migrations back.
     *
     * This is a carbon copy of the Laravel method
     * except in the "!isset($files[$migration])" part.
     *
     * @param  array|string $paths
     * @param  bool         $pretend
     * @return array
     */
    public function reset($paths = [], $pretend = false)
    {
        $this->repository->setMigrator($this);

        $this->notes = [];

        $rolledBack = [];

        $files = $this->getMigrationFiles($paths);

        // Next, we will reverse the migration list so we can run them back in the
        // correct order for resetting this database. This will allow us to get
        // the database back into its "empty" state ready for the migrations.
        $migrations = array_reverse($this->repository->getRan());

        $count = count($migrations);

        if ($count === 0) {
            $this->note('<info>Nothing to rollback.</info>');
        } else {
            $this->requireFiles($files);

            // Next we will run through all of the migrations and call the "down" method
            // which will reverse each migration in order. This will get the database
            // back to its original "empty" state and will be ready for migrations.
            foreach ($migrations as $migration) {

                /**
                 * This is the only adjustment to
                 * Laravel's method..
                 */
                if (!isset($files[$migration])) {
                    continue;
                }

                $rolledBack[] = $files[$migration];

                $this->runDown($files[$migration], (object)['migration' => $migration], $pretend);
            }
        }

        return $rolledBack;
    }

    /**
     * Rollback the last migration operation.
     *
     * @param  array|string $paths
     * @param  array        $options
     * @return array
     */
    public function rollback($paths = [], array $options = [])
    {
        $this->repository->setMigrator($this);

        return parent::rollback($paths, $options);
    }

    /**
     * Run "up" a migration instance.
     *
     * @param  string $file
     * @param  int    $batch
     * @param  bool   $pretend
     * @return void
     */
    protected function runUp($file, $batch, $pretend)
    {
        /**
         * Run our migrations first.
         *
         * @var Migration $migration
         */
        $migration = $this->resolve($file);

        /**
         * Set the addon if there is
         * one contextually available.
         *
         * @var Addon $addon
         */
        if ($addon = $this->getAddon()) {
            $migration->setAddon($addon);
        }

        if ($migration instanceof Migration) {
            $this->dispatchNow(new Migrate($migration));
        }

        parent::runUp($file, $batch, $pretend);
    }

    /**
     * Run "down" a migration instance.
     *
     * @param  string $file
     * @param  object $migration
     * @param  bool   $pretend
     * @return void
     */
    protected function runDown($file, $migration, $pretend)
    {
        /**
         * Run our migrations first.
         *
         * @var Migration $migration
         */
        $migration = $this->resolve($file);

        /**
         * Set the addon if there is
         * one contextually available.
         *
         * @var Addon $addon
         */
        if ($addon = $this->getAddon()) {
            $migration->setAddon($addon);
        }

        if ($migration instanceof Migration) {
            $this->dispatchNow(new Reset($migration));
        }

        parent::runDown($file, $migration, $pretend);
    }

    /**
     * Resolve a migration instance from a file.
     *
     * @param  string $file
     * @return object
     */
    public function resolve($file)
    {
        $migration = app((new MigrationName($file))->className());

        $migration->migration = (new MigrationName($file))->migration();

        return $migration;
    }

    /**
     * Resolve a migration instance from a migration path.
     *
     * @param  string  $path
     * @return object
     */
    protected function resolvePath(string $path)
    {
        return $this->resolve($path);
    }

    /**
     * Set the addon.
     *
     * @param Addon $addon
     */
    public function setAddon(Addon $addon)
    {
        $this->addon = $addon;

        return $this;
    }

    /**
     * Clear the addon.
     *
     * @param Addon $addon
     */
    public function clearAddon()
    {
        $this->addon = null;

        return $this;
    }

    /**
     * Get the addon.
     *
     * @return Addon
     */
    public function getAddon()
    {
        return $this->addon;
    }
}
