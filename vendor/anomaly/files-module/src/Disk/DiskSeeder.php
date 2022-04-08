<?php namespace Anomaly\FilesModule\Disk;

use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;

/**
 * Class DiskSeeder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DiskSeeder extends Seeder
{

    /**
     * The disk repository.
     *
     * @var DiskRepositoryInterface
     */
    protected $disks;

    /**
     * Create a new DiskSeeder instance.
     *
     * @param $disks
     */
    public function __construct(DiskRepositoryInterface $disks)
    {
        $this->disks = $disks;
    }

    /**
     * Run the seeder.
     */
    public function run()
    {
        $this->disks
            ->create(
                [
                    'en'      => [
                        'name'        => 'Local',
                        'description' => 'A local (private) storage disk.',
                    ],
                    'slug'    => 'local',
                    'adapter' => 'anomaly.extension.private_storage_adapter',
                ]
            );
    }
}
