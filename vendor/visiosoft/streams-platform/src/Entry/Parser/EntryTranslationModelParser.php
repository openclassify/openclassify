<?php namespace Anomaly\Streams\Platform\Entry\Parser;

use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class EntryTranslationModelParser
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class EntryTranslationModelParser
{

    /**
     * Return the entry translation model attribute.
     *
     * @param  StreamInterface $stream
     * @return null|string
     */
    public function parse(StreamInterface $stream)
    {
        if (!$stream->isTranslatable()) {
            return null;
        }

        $namespace = studly_case($stream->getNamespace());
        $class     = studly_case("{$stream->getNamespace()}_{$stream->getSlug()}") . 'EntryTranslationsModel';

        return 'protected $translationModel = \'Anomaly\Streams\Platform\Model\\' . $namespace . '\\' . $class . '\';';
    }
}
