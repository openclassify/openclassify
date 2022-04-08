<?php namespace Anomaly\Streams\Platform\Database\Migration\Stream;

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class StreamInput
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class StreamInput
{

    /**
     * The stream guesser.
     *
     * @var StreamGuesser
     */
    protected $guesser;

    /**
     * The stream normalizer.
     *
     * @var StreamNormalizer
     */
    protected $normalizer;

    /**
     * Create a new StreamInput instance.
     *
     * @param StreamGuesser $guesser
     * @param StreamNormalizer $normalizer
     */
    public function __construct(StreamGuesser $guesser, StreamNormalizer $normalizer)
    {
        $this->guesser    = $guesser;
        $this->normalizer = $normalizer;
    }

    /**
     * Read the streams input.
     *
     * @param Migration $migration
     */
    public function read(Migration $migration)
    {
        if (!$migration->getStream()) {
            return;
        }

        $this->normalizer->normalize($migration);
        $this->guesser->guess($migration);
    }
}
