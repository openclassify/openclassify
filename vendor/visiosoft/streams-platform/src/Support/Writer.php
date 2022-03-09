<?php namespace Anomaly\Streams\Platform\Support;

use Illuminate\Filesystem\Filesystem;

/**
 * Class Writer
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Writer
{

    /**
     * The file system.
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * Create a new Writer instance.
     *
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
    }

    /**
     * Append text to a file.
     *
     * @param     $path
     * @param     $pattern
     * @param     $text
     * @param int $limit
     * @return bool
     */
    public function append($path, $pattern, $text, $limit = 1)
    {
        $contents = $this->files->get($path);

        $contents = preg_replace(
            $pattern,
            '$0' . $text,
            $contents,
            $limit
        );

        return $this->files->put($path, $contents);
    }

    /**
     * Prepend text to a file.
     *
     * @param  string $path
     * @param  string $pattern
     * @param  string $text
     * @param  int    $limit
     * @return bool
     */
    public function prepend($path, $pattern, $text, $limit = 1)
    {
        $contents = $this->files->get($path);
        $contents = preg_replace(
            $pattern,
            $text . '$0',
            $contents,
            $limit
        );

        return $this->files->put($path, $contents);
    }

    /**
     * Replace text in a file.
     *
     * @param     $path
     * @param     $pattern
     * @param     $text
     * @param int $limit
     * @return bool
     */
    public function replace($path, $pattern, $text, $limit = 1)
    {
        $contents = $this->files->get($path);

        $contents = preg_replace(
            $pattern,
            $text,
            $contents,
            $limit
        );

        return $this->files->put($path, $contents);
    }
}
