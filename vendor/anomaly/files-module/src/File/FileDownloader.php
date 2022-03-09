<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FileDownloader
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FileDownloader extends FileResponse
{

    /**
     * Return the response headers.
     *
     * @param  FileInterface $file
     * @return Response
     */
    public function download(FileInterface $file)
    {
        $response = $this->make($file);

        return $response;
    }

    /**
     * Make the response.
     *
     * @param  FileInterface $file
     * @return Response
     */
    public function make(FileInterface $file)
    {
        $response = parent::make($file);

        $response->headers->set('Content-disposition', 'attachment; filename="' . $file->getName() . '"');

        $folder = $file->getFolder();
        $disk   = $folder->getDisk();

        return $response->setContent(
            $this->manager->read("{$disk->getSlug()}://{$folder->getSlug()}/{$file->getName()}")
        );
    }
}
