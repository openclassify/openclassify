<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FileReader
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FileReader extends FileResponse
{

    /**
     * Return the response headers.
     *
     * @param  FileInterface $file
     * @return Response
     */
    public function read(FileInterface $file)
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

        $response->headers->set('Content-Disposition', 'inline');

        return $response->setContent($this->manager->read($file->location()));
    }
}
