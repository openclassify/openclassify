<?php namespace Anomaly\FilesModule\File\Command;

use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Support\Decorator;


/**
 * Class GetFile
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetFile
{

    /**
     * The folder identifier.
     *
     * @var mixed
     */
    protected $identifier;

    /**
     * Create a new GetFile instance.
     *
     * @param $identifier
     */
    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * Handle the command.
     *
     * @param  FileRepositoryInterface   $files
     * @param  FolderRepositoryInterface $folders
     * @param  Decorator                 $decorator
     * @return \Anomaly\FilesModule\File\Contract\FileInterface|\Anomaly\Streams\Platform\Model\EloquentModel|null
     */
    public function handle(FileRepositoryInterface $files, FolderRepositoryInterface $folders)
    {
        if (is_numeric($this->identifier)) {
            return $files->find($this->identifier);
        }

        if (!is_numeric($this->identifier) && str_is('*://*/*', $this->identifier)) {

            list($disk, $folder, $name) = preg_split('/(:\/\/|\/)/', $this->identifier);

            if (!$folder = $folders->findBySlug($folder)) {
                return null;
            }

            return $files->findByNameAndFolder($name, $folder);
        }

        if (!is_numeric($this->identifier) && str_is('*/*', $this->identifier)) {

            list($folder, $name) = explode('/', $this->identifier);

            if (!$folder = $folders->findBySlug($folder)) {
                return null;
            }

            return $files->findByNameAndFolder($name, $folder);
        }

        return null;
    }
}
