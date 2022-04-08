<?php namespace Anomaly\Streams\Platform\Database\Migration;

use Illuminate\Database\Migrations\DatabaseMigrationRepository;

/**
 * Class MigrationRepository
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class MigrationRepository extends DatabaseMigrationRepository
{

    /**
     * The migrator instance.
     *
     * @var Migrator
     */
    protected $migrator = null;

    /**
     * Get ran migrations.
     *
     * @return array
     */
    public function getRan($namespace = null)
    {
        if ($this->migrator && $addon = $this->migrator->getAddon()) {
            return $this->table()
                ->orderBy('batch', 'asc')
                ->orderBy('migration', 'asc')
                ->where('migration', 'LIKE', '%' . $addon->getNamespace() . '%')
                ->pluck('migration')->all();
        }

        return parent::getRan();
    }

    /**
     * Set the migrator.
     *
     * @param Migrator $migrator
     * @return $this
     */
    public function setMigrator(Migrator $migrator)
    {
        $this->migrator = $migrator;

        return $this;
    }
}
