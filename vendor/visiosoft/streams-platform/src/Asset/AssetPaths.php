<?php

namespace Anomaly\Streams\Platform\Asset;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\Config\Repository;
use Anomaly\Streams\Platform\Application\Application;

/**
 * Class AssetPaths
 *
 * @link       http://pyrocms.com/
 * @author     PyroCMS, Inc. <support@pyrocms.com>
 * @author     Ryan Thompson <ryan@pyrocms.com>
 */
class AssetPaths
{

    /**
     * Predefined paths.
     *
     * @var array
     */
    protected $paths = [];

    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * The application object.
     *
     * @var Application
     */
    protected $application;

    /**
     * Create a new AssetPaths instance.
     *
     * @param Repository $config
     * @param Request $request
     */
    public function __construct(Repository $config, Request $request, Application $application)
    {
        $this->config      = $config;
        $this->request     = $request;
        $this->application = $application;

        $this->paths = $config->get('streams::assets.paths', []);
    }

    /**
     * Get the paths.
     *
     * @return array|mixed
     */
    public function getPaths()
    {
        return $this->paths;
    }

    /**
     * Set the paths.
     *
     * @param  array $paths
     * @return $this
     */
    public function setPaths(array $paths)
    {
        $this->paths = $paths;

        return $this;
    }

    /**
     * Add an image path hint.
     *
     * @param $namespace
     * @param $path
     * @return $this
     */
    public function addPath($namespace, $path)
    {
        $this->paths[$namespace] = rtrim($path, '/\\');

        return $this;
    }

    /**
     * Get a single path.
     *
     * @param $namespace
     * @return string|null
     */
    public function getPath($namespace)
    {
        return array_get($this->paths, $namespace);
    }

    /**
     * Return the hinted extension.
     *
     * @param $path
     * @return string
     */
    public function hint($path)
    {
        $hint = $this->extension($path);

        foreach ($this->config->get('streams::assets.hints', []) as $extension => $hints) {
            if (in_array($hint, $hints)) {
                return $extension;
            }
        }

        return $hint;
    }

    /**
     * Return the extension of the path.
     *
     * @param $path
     * @return string
     */
    public function extension($path)
    {
        return pathinfo($path, PATHINFO_EXTENSION);
    }

    /**
     * Return the real path for a given path.
     *
     * @param $path
     * @return string
     * @throws \Exception
     */
    public function realPath($path)
    {
        if (Str::contains($path, '::')) {

            list($namespace, $path) = explode('::', $path);

            if (!isset($this->paths[$namespace])) {
                throw new \Exception("Path hint [{$namespace}::{$path}] does not exist!");
            }

            $path = rtrim($this->paths[$namespace], '/') . '/' . $path;
        }

        if (strpos($path, '?v=')) {
            $path = substr($path, 0, strpos($path, '?v='));
        }

        return $path;
    }

    /**
     * Return the download path for a remote asset.
     *
     * @param         $url
     * @param  null $path
     * @return string
     */
    public function downloadPath($url, $path = null)
    {
        if (!$path && $parsed = parse_url($url)) {
            $path = array_get($parsed, 'host') . '/' . basename(array_get($parsed, 'path'));
        }

        return $path = str_replace(public_path(), '', $this->application->getAssetsPath('downloads/' . $path));
    }

    /**
     * Return the output path.
     *
     * @param $collection
     * @return string
     */
    public function outputPath($collection)
    {
        /*
         * If the path is already public
         * then just use it as it is.
         */
        if (Str::contains($collection, public_path())) {
            return str_replace(public_path(), '', $collection);
        }

        /*
         * Get the real path relative to our installation.
         */
        $path = str_replace(base_path(), '', $this->realPath($collection));

        /*
         * Build out path parts.
         */
        $directory   = ltrim(dirname($path), '/\\') . '/';
        $application = $this->application->getReference();
        $filename    = basename($path, $this->extension($path)) . $this->hint($path);

        if (starts_with($directory, 'vendor/')) {
            $directory = substr($directory, 7);
        }

        if (starts_with($directory, './')) {
            $directory = in_array($this->request->segment(1), ['admin', 'installer']) ? 'admin/' : 'public/';
        }

        return "/app/{$application}/assets/{$directory}{$filename}";
    }
}
