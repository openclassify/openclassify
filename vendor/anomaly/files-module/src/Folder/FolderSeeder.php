<?php namespace Anomaly\FilesModule\Folder;

use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;

/**
 * Class FolderSeeder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FolderSeeder extends Seeder
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
                    'name'        => 'Images',
                    'description' => 'A folder for images.',
                ],
                'slug'          => 'images',
                'disk'          => $disk,
                'allowed_types' => [
                    'png',
                    'jpeg',
                    'jpg',
                ],
            ]
        );

        $this->folders->create(
            [
                'en'            => [
                    'name'        => 'Documents',
                    'description' => 'A folder for documents.',
                ],
                'slug'          => 'documents',
                'disk'          => $disk,
                'allowed_types' => [
                    'pdf',
                    'docx',
                ],
            ]
        );
    }
}
