<?php namespace Anomaly\Streams\Platform\Stream\Command;

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class MergeStreamConfig
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class MergeStreamConfig
{

    /**
     * The stream instance.
     *
     * @var StreamInterface
     */
    protected $stream;

    /**
     * Create a new MergeStreamConfig instance.
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
     * @param AddonCollection $addons
     */
    public function handle(AddonCollection $addons)
    {
        $slug      = $this->stream->getSlug();
        $namespace = $this->stream->getNamespace();

        foreach ($addons->withConfig("streams.{$namespace}.{$slug}") as $config) {
            $this->stream->mergeConfig($config);
        }

        $this->stream->mergeConfig(config("streams::streams.{$namespace}.{$slug}", []));
    }
}
