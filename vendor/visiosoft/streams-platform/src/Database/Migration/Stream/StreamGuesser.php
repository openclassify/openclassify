<?php namespace Anomaly\Streams\Platform\Database\Migration\Stream;

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Anomaly\Streams\Platform\Database\Migration\Stream\Guesser\TranslationGuesser;

class StreamGuesser
{
    /**
     * The translation guesser.
     *
     * @var TranslationGuesser
     */
    protected $translation;

    /**
     * Create a new StreamGuesser instance.
     *
     * @param TranslationGuesser $translation
     */
    public function __construct(TranslationGuesser $translation)
    {
        $this->translation = $translation;
    }

    /**
     * Guess stream definition parameters for the migration.
     *
     * @param Migration $migration
     */
    public function guess(Migration $migration)
    {
        $this->translation->guess($migration);
    }
}
