<?php namespace Anomaly\Streams\Platform\Database\Migration\Assignment;

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Anomaly\Streams\Platform\Database\Migration\Assignment\Guesser\TranslationGuesser;

class AssignmentGuesser
{
    /**
     * The translation guesser.
     *
     * @var TranslationGuesser
     */
    protected $translation;

    /**
     * Create a new AssignmentGuesser instance.
     *
     * @param TranslationGuesser $translation
     */
    public function __construct(TranslationGuesser $translation)
    {
        $this->translation = $translation;
    }

    /**
     * Guess assignment definition parameters for the migration.
     *
     * @param Migration $migration
     */
    public function guess(Migration $migration)
    {
        $this->translation->guess($migration);
    }
}
