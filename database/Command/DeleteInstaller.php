<?php namespace Visiosoft\AdvsModule\Adv\Command;

use Illuminate\Filesystem\Filesystem;

class DeleteInstaller
{
    public function handle(Filesystem $files)
    {
        $json = file_get_contents(base_path('composer.json'));

        $pattern = '/,\s*("anomaly\/installer-module").*"/';

        $files->put(base_path('composer.json'), preg_replace($pattern, '', $json));

        $files->deleteDirectory(base_path('vendor/anomaly/installer-module'));
    }
}
