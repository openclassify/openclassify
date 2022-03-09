<?php namespace Anomaly\FilesModule\File;

use Anomaly\Streams\Platform\Image\Image;
use Illuminate\Routing\ResponseFactory;
use League\Flysystem\MountManager;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FileImage
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FileImage extends FileResponse
{

    /**
     * The image utility.
     *
     * @var Image
     */
    protected $image;

    /**
     * Create a new FileImage instance.
     *
     * @param ResponseFactory $response
     * @param MountManager    $manager
     * @param Image           $image
     */
    public function __construct(ResponseFactory $response, MountManager $manager, Image $image)
    {
        $this->image = $image;

        parent::__construct($response, $manager);
    }

    /**
     * Return the response headers.
     *
     * @param  Image $image
     * @param  int   $quality
     * @return Response
     */
    public function generate(Image $image, $quality = 60)
    {
        $image->quality($quality);

        $response = parent::make($image->getImage());

        $response->headers->set('Content-Disposition', 'inline');
        $response->headers->remove('Content-Length');

        $response = $response->setContent(
            file_get_contents(base_path('public' . DIRECTORY_SEPARATOR . $image->path()))
        );

        return $response;
    }
}
