<?php namespace Visiosoft\ProfileModule;

use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Visiosoft\ProfileModule\Education\EducationSeeder;
use Visiosoft\ProfileModule\Seed\UsersFieldsSeeder;

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
        // Users Fields Seeder
        $this->call(UsersFieldsSeeder::class);

        //Educations Seeder
        $this->call(EducationSeeder::class);
    }
}