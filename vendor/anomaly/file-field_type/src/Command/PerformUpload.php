<?php namespace Anomaly\FileFieldType\Command;

use Anomaly\FileFieldType\FileFieldType;
use Anomaly\FileFieldType\FileFieldTypeParser;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Illuminate\Http\Request;
use League\Flysystem\MountManager;

/**
 * Class PerformUpload
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PerformUpload
{

    /**
     * The field type instance.
     *
     * @var FileFieldType
     */
    protected $fieldType;

    /**
     * Create a new PerformUpload instance.
     *
     * @param FileFieldType $fieldType
     */
    public function __construct(FileFieldType $fieldType)
    {
        $this->fieldType = $fieldType;
    }

    /**
     * Handle the command.
     *
     * @param DiskRepositoryInterface $disks
     * @param FileRepositoryInterface $files
     * @param FileFieldTypeParser     $parser
     * @param Request                 $request
     * @param MountManager            $manager
     *
     * @return null|bool|FileInterface
     */
    public function handle(
        DiskRepositoryInterface $disks,
        FileRepositoryInterface $files,
        FileFieldTypeParser $parser,
        Request $request,
        MountManager $manager
    ) {
        $path = trim(array_get($this->fieldType->getConfig(), 'path'), './');

        $file  = $request->file($this->fieldType->getInputName());
        $value = $request->get($this->fieldType->getInputName() . '_id');

        /*
         * Make sure we have at least
         * some kind of input.
         */
        if ($file === null) {

            if (!$value) {
                return null;
            }

            return $files->find($value);
        }

        // Make sure we have a valid upload disk. First by slug.
        if (!$disk = $disks->findBySlug($slug = array_get($this->fieldType->getConfig(), 'disk'))) {
            // If that fails look up by id.
            if (!$disk = $disks->find($id = array_get($this->fieldType->getConfig(), 'disk'))) {
                return null;
            }
        }

        // Make the path.
        $path = $parser->parse($path, $this->fieldType);
        $path = (!empty($path) ? $path . '/' : null) . $file->getClientOriginalName();

        //return $manager->putStream($disk->path($path), fopen($file->getRealPath(), 'r+'));
         return $manager->putStream($disk->getSlug() . '://' . $path, fopen($file->getRealPath(), 'r+'));
    }
}
