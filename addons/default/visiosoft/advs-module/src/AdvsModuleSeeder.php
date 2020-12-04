<?php namespace Visiosoft\AdvsModule;

use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;

class AdvsModuleSeeder extends Seeder
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
     * @param DiskRepositoryInterface $disks
     * @param FolderRepositoryInterface $folders
     */
    public function __construct(DiskRepositoryInterface $disks, FolderRepositoryInterface $folders)
    {
        parent::__construct();

        $this->disks = $disks;
        $this->folders = $folders;
    }

    /**
     * Run the seeder.
     */
    public function run()
    {
        //Create Store Icon Folder
        if (!$this->folders->findBySlug('ads_excel')) {
            $disk = $this->disks->findBySlug('local');

            $this->folders->create([
                'en' => [
                    'name' => 'Ads Excel',
                    'description' => 'A folder for Ads Excel.',
                ],
                'slug' => 'ads_excel',
                'disk' => $disk
            ]);
        };
    }
}