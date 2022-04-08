<?php namespace Anomaly\Streams\Platform\Stream\Command;

use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Illuminate\Filesystem\Filesystem;

/**
 * Class DeleteStreamEntryModels
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DeleteStreamEntryModels
{

    /**
     * The stream instance.
     *
     * @var StreamInterface
     */
    protected $stream;

    /**
     * Create a new DeleteStreamEntryModels instance.
     *
     * @param StreamInterface $stream
     */
    public function __construct(StreamInterface $stream)
    {
        $this->stream = $stream;
    }

    /**
     * Handle the command.
     *
     * @param  Filesystem  $files
     * @param  Application $application
     * @return string
     */
    public function handle(Filesystem $files, Application $application)
    {
        $path = $application->getStoragePath('models/' . studly_case($this->stream->getNamespace()));

        $model = $path . '/' . studly_case($this->stream->getNamespace()) . studly_case(
                $this->stream->getSlug()
            ) . 'EntryModel.php';

        if ($files->exists($model)) {
            $files->delete($model);
        }

        if (!$this->stream->isTranslatable()) {
            return;
        }

        $model = $path . '/' . studly_case($this->stream->getNamespace()) . studly_case(
                $this->stream->getSlug()
            ) . 'EntryTranslationsModel.php';

        if ($files->exists($model)) {
            $files->delete($model);
        }
    }
}
