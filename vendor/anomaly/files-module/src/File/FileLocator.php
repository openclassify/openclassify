<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class FileLocator
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FileLocator
{

    /**
     * The auth utility.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The file repository.
     *
     * @var FileRepositoryInterface
     */
    protected $files;

    /**
     * The folder repository.
     *
     * @var FolderRepositoryInterface
     */
    protected $folders;

    /**
     * @param FileRepositoryInterface   $files
     * @param FolderRepositoryInterface $folders
     * @param Guard                     $auth
     */
    function __construct(FileRepositoryInterface $files, FolderRepositoryInterface $folders, Guard $auth)
    {
        $this->auth    = $auth;
        $this->files   = $files;
        $this->folders = $folders;
    }

    /**
     * Locate a file by disk and path.
     *
     * @param $folder
     * @param $name
     * @return FileInterface|null
     */
    public function locate($folder, $name)
    {
        if ( !$folder = $this->folders->findBySlug($folder) ){
            return null;
        }

        if (!$file = $this->files->findByNameAndFolder($name, $folder)) {
            return null;
        }

        return $file;
    }
}
