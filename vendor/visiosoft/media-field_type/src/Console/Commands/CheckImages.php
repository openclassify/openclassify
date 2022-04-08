<?php

namespace Visiosoft\MediaFieldType\Console\Commands;

use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Console\Command;
use Anomaly\Streams\Platform\Model\Files\FilesImagesEntryModel;

class CheckImages extends Command
{
    protected $signature = 'images:check';
    protected $description = "";

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(
        FileRepositoryInterface   $fileRepository,
        FolderRepositoryInterface $folderRepository
    )
    {
        $path = storage_path('streams/default/files-module/local/images');
        $files = scandir($path);

        try {
            foreach ($files as $file) {
                $this->line('checking: ' . $file);
                $full_path = $path . '/' . $file;
                if (is_file($full_path)
                    && ($folder = $folderRepository->findBySlug('images'))
                    && !$fileRepository->findByNameAndFolder($file, $folder)) {

                    $fileInfo = pathinfo($full_path);
                    $size = filesize($full_path);
                    $dimensions = getimagesize($full_path);
                    $mimeType = mime_content_type($full_path);

                    $file = $fileRepository->create([
                        'size' => $size,
                        'width' => $dimensions[0],
                        'height' => $dimensions[1],
                        'mime_type' => $mimeType,
                        'name' => $fileInfo['basename'],
                        'folder' => $folder,
                        'disk' => $folder->getDisk(),
                        'extension' => $fileInfo['extension'],
                        'entry_type' => FilesImagesEntryModel::class,
                        'str_id' => $fileInfo['filename'] . random_int(0, 999999),
                    ]);

                    if ($file) {
                        $this->info('created: ' . $fileInfo['basename']);
                    }
                }
            }
        } catch (ClientException $exception) {
            $this->error($exception->getMessage());
        }
    }
}
