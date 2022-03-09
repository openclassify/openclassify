<?php namespace Anomaly\Streams\Platform\Entry\Parser;

use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class EntryTranslationForeignKeyParser
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class EntryTranslationForeignKeyParser
{

    /**
     * Return the translation foreign key attribute.
     *
     * @param  StreamInterface $stream
     * @return null|string
     */
    public function parse(StreamInterface $stream)
    {
        if (!$stream->isTranslatable()) {
            return null;
        }

        return 'protected $translationForeignKey = \'entry_id\';';
    }
}
