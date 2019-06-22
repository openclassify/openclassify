<?php namespace Visiosoft\ProfileModule;

use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;

use Illuminate\Support\Facades\DB;

class ProfileModuleSeeder extends Seeder
{

    /**
     * The disk repository.
     *
     * @var DiskRepositoryInterface
     */
    protected $disks;

    /**
     * The folder repository.
     *
     * @var FolderRepositoryInterface
     */
    protected $folders;

    /**
     * Create a new FolderSeeder instance.
     *
     * @param DiskRepositoryInterface   $disks
     * @param FolderRepositoryInterface $folders
     */
    public function __construct(DiskRepositoryInterface $disks, FolderRepositoryInterface $folders)
    {
        $this->disks   = $disks;
        $this->folders = $folders;
    }

    /**
     * Run the seeder.
     */
    public function run()
    {
        $disk = $this->disks->findBySlug('local');

        $this->folders->create(
            [
                'en'            => [
                    'name'        => 'ADV LISTING PAGE IMAGE',
                    'description' => 'A folder for adv listing page images.',
                ],
                'slug'          => 'adv_listing_page',
                'disk'          => $disk,
                'allowed_types' => [
                    'png',
                    'jpeg',
                    'jpg',
                ],
            ]
        );
    }

}