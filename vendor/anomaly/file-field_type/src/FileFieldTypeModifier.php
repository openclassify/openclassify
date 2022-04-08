<?php namespace Anomaly\FileFieldType;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\File\FilePresenter;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeModifier;

/**
 * Class FileFieldTypeModifier
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FileFieldTypeModifier extends FieldTypeModifier
{

    /**
     * The files repository.
     *
     * @var FileRepositoryInterface
     */
    protected $files;

    /**
     * Create a new FileFieldTypeModifier instance.
     *
     * @param FileRepositoryInterface $files
     */
    public function __construct(FileRepositoryInterface $files)
    {
        $this->files = $files;
    }

    /**
     * Modify the value for database storage.
     *
     * @param  $value
     * @return int
     */
    public function modify($value)
    {
        if ($value instanceof FilePresenter) {
            $value = $value->getObject();
        }

        if ($value instanceof FileInterface) {
            return $value->getId();
        }

        if ($value && $file = $this->files->find($value)) {
            return $file->getId();
        }

        return null;
    }
}
