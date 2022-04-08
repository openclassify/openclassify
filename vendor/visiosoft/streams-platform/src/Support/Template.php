<?php namespace Anomaly\Streams\Platform\Support;

use Anomaly\Streams\Platform\Application\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Filesystem\Filesystem;

/**
 * Class Template
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Template
{

    /**
     * The view factory.
     *
     * @var Factory
     */
    protected $view;

    /**
     * The file system.
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * The application instance.
     *
     * @var Application
     */
    protected $application;

    /**
     * Create a new Template instance.
     *
     * @param Factory $view
     * @param Filesystem $files
     * @param Application $application
     */
    public function __construct(
        Factory $view,
        Filesystem $files,
        Application $application
    ) {
        $this->view        = $view;
        $this->files       = $files;
        $this->application = $application;
    }

    /**
     * Render a string template.
     *
     * @param       $template
     * @param array $payload
     * @return \Illuminate\Contracts\View\View
     */
    public function render($template, array $payload = [])
    {
        $path = $this->path($template);

        return $this->view->make(
            'storage::' . ltrim(
                str_replace($this->application->getStoragePath(), '', $path),
                '\\/'
            ),
            $payload
        );
    }

    /**
     * Make a string template.
     *
     * @param       $template
     * @param string $extension
     * @return string
     */
    public function make($template, $extension = 'twig')
    {
        $path = $this->path($template, $extension);

        return 'storage::' . ltrim(
                str_replace($this->application->getStoragePath(), '', $path),
                '\\/'
            );
    }

    /**
     * Make a string asset template.
     *
     * @param $template
     * @param $extension
     * @return string
     */
    public function asset($template, $extension)
    {
        $path = $this->path($template, $extension);

        return 'storage::' . ltrim(
                str_replace($this->application->getStoragePath(), '', $path),
                '\\/'
            ) . '.' . $extension;
    }

    /**
     * Return the path to a string template.
     *
     * @param $template
     * @param string $extension
     * @return string
     */
    public function path($template, $extension = 'twig')
    {
        $path = $this->application->getStoragePath('support/parsed/' . md5($template));

        if (!$this->files->isDirectory($directory = dirname($path))) {
            $this->files->makeDirectory($directory, 0777, true);
        }

        if (!$this->files->exists($path . '.' . $extension)) {
            $this->files->put($path . '.' . $extension, $template);
        }

        return $path;
    }

}
