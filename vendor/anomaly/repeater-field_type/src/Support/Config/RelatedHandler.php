<?php namespace Anomaly\RepeaterFieldType\Support\Config;

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
     * Handle the command.
     *
     * @param SelectFieldType $fieldType
     * @param StreamRepositoryInterface $streams
     */
    public function handle(SelectFieldType $fieldType, StreamRepositoryInterface $streams)
    {
        $repeaters = $streams->findAllByNamespace('repeater');

        $options = array_combine(
            $repeaters->map(
                function (StreamInterface $stream) {
                    return $stream->getEntryModelName();
                }
            )->all(),
            $repeaters->map(
                function (StreamInterface $stream) {
                    return $stream->getName();
                }
            )->all()
        );

        ksort($options);

        $fieldType->setOptions($options);
    }
}
