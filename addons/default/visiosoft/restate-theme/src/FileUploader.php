<?php namespace Visiosoft\RestateTheme;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\File\FileRotator;
use Anomaly\FilesModule\File\FileSanitizer;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Validation\Factory;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileUploader
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FileUploader
{

    /**
     * The file repository.
     *
     * @var FileRepositoryInterface
     */
    protected $files;

    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * The mount manager.
     *
     * @var FilesystemManager
     */
    protected $manager;

    /**
     * The file rotator.
     *
     * @var FileRotator
     */
    protected $rotator;

    /**
     * The validation factory.
     *
     * @var Factory
     */
    protected $validator;

    /**
     * Create a new FileUploader instance.
     *
     * @param Factory $validator
     * @param FileRotator $rotator
     * @param FilesystemManager $manager
     * @param FileRepositoryInterface $files
     */
    public function __construct(
        Factory                 $validator,
        FileRotator             $rotator,
        FilesystemManager       $manager,
        FileRepositoryInterface $files
    )
    {
        $this->files = $files;
        $this->manager = $manager;
        $this->rotator = $rotator;
        $this->validator = $validator;
    }

    /**
     * Upload a file.
     *
     * @param UploadedFile $file
     * @param FolderInterface $folder
     * @return bool|FileInterface
     */
    public function upload(UploadedFile $file, FolderInterface $folder)
    {
        $rules = 'required';

        /**
         * Append mime rules with the folder's allowed types.
         */
        if ($allowed = $folder->getAllowedTypes()) {
            $rules .= '|mimes:' . implode(',', $allowed);
        }

        /**
         * Check against the configured executable file types
         * to prevent wide open file upload vulnerabilities.
         */
        if (
            !$allowed &&
            in_array($file->getClientOriginalExtension(), config('anomaly.module.files::mimes.types.executable', []))
        ) {
            throw new \Exception('The uploaded file type is executable and not inherently allowed.');
        }


        $disk = $folder->getDisk();

        /**
         * Rotate filename to unique-ify it.
         */
        $file = $this->rotator->rotate($file);

        /**
         * Get file extension
         */
        $type = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

        /**
         * Define path
         */
        $path = $folder->getSlug() . '/' . $folder->getSlug() . '/' . FileSanitizer::clean($file->getClientOriginalName());

        /**
         * Write the file to the filesystem.
         */
        $entry = $this->manager->disk($disk->getSlug())->write($path, file_get_contents($file->getRealPath()));

        /**
         * Generate and store extra details about image files.
         */
        if (in_array($type, config('anomaly.module.files::mimes.types.image'))) {

            $dimensions = getimagesize($file->getRealPath());

            $this->files->save(
                $entry
                    ->setAttribute('size', filesize($file->getRealPath()))
                    ->setAttribute('width', isset($dimensions[0]) ? $dimensions[0] : null)
                    ->setAttribute('height', isset($dimensions[1]) ? $dimensions[1] : null)
                    ->setAttribute('mime_type', $file->getMimetype())
            );
        }

        return $entry;
    }
}
