<?php namespace Anomaly\FilesModule;

use Anomaly\FilesModule\Disk\Command\LoadDisks;
use Anomaly\FilesModule\Disk\Command\RegisterDisks;
use Anomaly\FilesModule\Disk\DiskSeeder;
use Anomaly\FilesModule\Folder\FolderSeeder;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class FilesModuleSeeder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FilesModuleSeeder extends Seeder
{

    use DispatchesJobs;

    /**
     * Run the seeder.
     */
    public function run()
    {
        $this->call(DiskSeeder::class);

        $this->dispatch(new LoadDisks());

        $this->call(FolderSeeder::class);
    }
}
