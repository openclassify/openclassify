<?php namespace Anomaly\FilesModule\File\Command;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\Streams\Platform\Image\Image;

/**
 * Class GetImage
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetImage
{

    /**
     * The file instance.
     *
     * @var FileInterface
     */
    protected $file;

    /**
     * Create a new GetImage instance.
     *
     * @param FileInterface $file
     */
    public function __construct(FileInterface $file)
    {
        $this->file = $file;
    }

    /**
     * Handle the command.
     *
     * @param  Image $image
     * @return Image
     */
    public function handle(Image $image)
    {
        return $image->make($this->file)->setOutput('image');
    }
}
