<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;

/**
 * Class FileCollection
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FileCollection extends EntryCollection
{

    /**
     * Return files of a desired type.
     *
     * @param $type
     * @return static|FileCollection
     */
    public function type($type)
    {
        $files = [];

        /* @var FileInterface $item */
        foreach ($this->items as $item) {
            if ($item->type() === $type) {
                $files[] = $item;
            }
        }

        return new static($files);
    }

    /**
     * Return files of a desired mime type.
     *
     * @param $type
     * @return static|FileCollection
     */
    public function mimeType($type)
    {
        $files = [];

        /* @var FileInterface $item */
        foreach ($this->items as $item) {
            if (str_is($type, $item->getMimeType())) {
                $files[] = $item;
            }
        }

        return new static($files);
    }
}
