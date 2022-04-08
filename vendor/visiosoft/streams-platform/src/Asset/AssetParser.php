<?php namespace Anomaly\Streams\Platform\Asset;

use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Factory;

/**
 * Class AssetParser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AssetParser
{

    /**
     * The filesystem.
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * The view factory.
     *
     * @var Factory
     */
    protected $views;

    /**
     * Create a new AssetParser instance.
     *
     * @param Filesystem $files
     * @param Factory    $views
     */
    public function __construct(Filesystem $files, Factory $views)
    {
        $this->files = $files;
        $this->views = $views;
    }

    /**
     * Parse some content.
     *
     * @param $content
     * @return string
     */
    public function parse($content)
    {
        if (!$this->files->isDirectory($path = storage_path('framework/views/asset'))) {
            $this->files->makeDirectory($path);
        }

        $this->files->put(storage_path('framework/views/asset/' . (($filename = md5($content)) . '.twig')), $content);

        return $this->views->make('root::storage/framework/views/asset/' . $filename)->render();
    }
}
