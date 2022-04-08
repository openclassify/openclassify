<?php namespace Anomaly\FilesModule\Disk\Adapter\Command;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;

/**
 * Class MoveFile
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class MoveFile
{

    /**
     * The destination path.
     *
     * @var string
     */
    private $to;

    /**
     * The source path.
     *
     * @var string
     */
    private $from;

    /**
     * Create a new MoveFile instance.
     *
     * @param $from
     * @param $to
     */
    function __construct($from, $to)
    {
        $this->from = $from;
        $this->to   = $to;
    }

    /**
     * Handle the command.
     *
     * @param FileRepositoryInterface $files
     * @param FolderRepositoryInterface $folders
     */
    public function handle(FileRepositoryInterface $files, FolderRepositoryInterface $folders)
    {
        list($fromDisk, $fromPath) = explode('://', $this->from, 2);
        list($toDisk, $toPath) = explode('://', $this->to, 2);

        /* @var FileInterface|EloquentModel $file */
        $file = $files->findByNameAndFolder(basename($this->from), $folders->findBySlug(dirname($fromPath)));

        return $file ? $files->save(
            $file
                ->setAttribute('name', basename($this->to))
                ->setAttribute('folder', $folders->findBySlug(dirname($toPath)))
        ) : false;
    }
}
