<?php namespace Visiosoft\AdvsModule\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteNonExistingCoverPhotos extends Command
{
    protected $signature = 'classifieds:refresh-cover-images';

    protected $description = 'Nullify non existing cover images.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $classifieds = DB::table('advs_advs')
            ->whereNotNull('cover_photo')
            ->get();

        $nullableClassifieds = array();
        foreach ($classifieds as $classified) {
            $name = pathinfo($classified->cover_photo);

            if (!file_exists(storage_path("streams/default/files-module/local/images/{$name['basename']}"))) {
                $nullableClassifieds[] = $classified->id;
            }
        }

        DB::table('advs_advs')
            ->whereIn('id', $nullableClassifieds)
            ->update(['cover_photo' => null]);

        $this->info('Classifieds refreshed!');
    }
}
