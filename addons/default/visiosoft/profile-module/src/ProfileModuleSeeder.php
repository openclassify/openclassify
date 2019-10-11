<?php namespace Visiosoft\ProfileModule;

use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Illuminate\Database\Eloquent\Model;
use Chumper\Zipper\Zipper;


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

        $disk = $this->disks->findBySlug('local');

        $this->folders->create(
            [
                'en'            => [
                    'name'        => 'Favicon',
                    'description' => 'A folder for Favicon.',
                ],
                'slug'          => 'favicon',
                'disk'          => $disk,
                'allowed_types' => [
                    'ico'
                ],
            ]
        );



        $repository = "https://raw.githubusercontent.com/openclassify/Openclassify-Demo-Data/master/";
        file_put_contents(__DIR__ . "/advListingPage.sql", fopen($repository . "advListingPage.sql", 'r'));
        file_put_contents("adv_listing_page.zip", fopen($repository . "adv_listing_page.zip", 'r'));
        $zipper = new Zipper();
        $zipper->make('adv_listing_page.zip')->folder('adv_listing_page')->extractTo(base_path() . '/public/app/default/files-module/local/adv_listing_page/');
        $zipper->close();

        Model::unguard();
        DB::unprepared(file_get_contents(__DIR__ . '/advListingPage.sql'));
        Model::reguard();
    }

}