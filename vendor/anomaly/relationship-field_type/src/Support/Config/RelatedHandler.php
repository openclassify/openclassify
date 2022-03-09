<?php namespace Anomaly\RelationshipFieldType\Support\Config;

use Anomaly\SelectFieldType\SelectFieldType;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;

/**
 * Class RelatedHandler
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RelatedHandler
{

    /**
     * Handle the options.
     *
     * @param SelectFieldType $fieldType
     * @param StreamRepositoryInterface $streams
     */
    public function handle(SelectFieldType $fieldType, StreamRepositoryInterface $streams)
    {
        $options = [];

        /* @var StreamInterface as $stream */
        foreach ($streams->visible() as $stream) {
            $options[ucwords(str_replace('_', ' ', $stream->getNamespace()))][$stream->getEntryModelName(
            )] = $stream->getName();
        }

        foreach ($options as $namespace) {
            ksort($namespace);
        }

        ksort($options);

        $fieldType->setOptions($options);
    }
}
