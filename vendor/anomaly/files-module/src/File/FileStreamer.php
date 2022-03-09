<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
use League\Flysystem\MountManager;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FileStreamer
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FileStreamer extends FileResponse
{

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * Create a new FileStreamer instance.
     *
     * @param Request $request
     * @param MountManager $manager
     * @param ResponseFactory $response
     */
    public function __construct(
        Request $request,
        MountManager $manager,
        ResponseFactory $response
    ) {
        $this->request = $request;

        parent::__construct($response, $manager);
    }

    /**
     * Return the response headers.
     *
     * @param  FileInterface $file
     * @return Response
     */
    public function stream(FileInterface $file)
    {
        $response = $this->make($file);

        $stream = $this->manager->readStream($file->location());

        return $this->response->stream(
            function () use ($stream) {
                fpassthru($stream);
            },
            200,
            array_combine(
                array_keys($response->headers->allPreserveCase()),
                array_map(
                    function ($header) {
                        return array_shift($header);
                    },
                    $response->headers->all()
                )
            )
        );
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

        $response->headers->set('Accept-Ranges', 'bytes');
        $response->headers->set('Cache-Control', 'no-cache'); // Cache breaks streaming.
        $response->headers->set('Content-Length', $file->getSize());

        $this->chunk($response, $file);

        return $response;
    }

    /**
     * Chunk the request into parts as
     * desired by the request range header.
     *
     * @param Response $response
     * @param FileInterface $file
     */
    protected function chunk(Response $response, FileInterface $file)
    {
        $size = $chunkStart = $file->getSize();

        $end = $chunkEnd = $size;

        $response->headers->set('Content-length', $size);
        $response->headers->set('Content-Range', "bytes 0-{$end}/{$size}");

        if (!$range = $this->request->server->get('HTTP_RANGE')) {
            return;
        }

        list(, $range) = explode('=', $this->request->server->get('HTTP_RANGE'), 2);

        if (strpos($range, ',') !== false) {
            $response->setStatusCode(416, 'Requested Range Not Satisfiable');
            $response->headers->set('Content-Range', "bytes 0-{$end}/{$size}");
        }

        if ($range == '-') {
            $chunkStart = $size - substr($range, 1);
        } else {
            $range      = explode('-', $range);
            $chunkStart = $range[0];
            $chunkEnd   = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $size;
        }

        $chunkEnd = ($chunkEnd > $end) ? $end : $chunkEnd;

        if ($chunkStart > $chunkEnd || $chunkStart > $size || $chunkEnd >= $size) {
            $response->setStatusCode(416, 'Requested Range Not Satisfiable');
            $response->headers->set('Content-Range', "bytes 0-{$end}/{$size}");
        }
    }
}
