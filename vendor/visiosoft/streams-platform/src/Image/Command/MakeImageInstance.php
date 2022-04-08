<?php namespace Anomaly\Streams\Platform\Image\Command;

use Anomaly\Streams\Platform\Image\Image;

/**
 * Class MakeImageInstance
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class MakeImageInstance
{

    /**
     * The image identifier.
     *
     * @var string
     */
    protected $image;

    /**
     * The output method.
     *
     * @var string
     */
    protected $output;

    /**
     * Create a new MakeImageInstance instance.
     *
     * @param $image
     */
    public function __construct($image, $output = 'img')
    {
        $this->image  = $image;
        $this->output = $output;
    }

    /**
     * Handle the command.
     *
     * @param  Image $image
     * @return Image
     */
    public function handle(Image $image)
    {
        return $image->make($this->image)->setOutput($this->output);
    }
}
