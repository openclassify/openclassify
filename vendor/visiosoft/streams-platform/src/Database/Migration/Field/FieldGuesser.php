<?php namespace Anomaly\Streams\Platform\Database\Migration\Field;

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Anomaly\Streams\Platform\Database\Migration\Field\Guesser\TranslationGuesser;

class FieldGuesser
{
    /**
     * The translation guesser.
     *
     * @var TranslationGuesser
     */
    protected $translation;

    /**
     * Create a new FieldGuesser instance.
     *
     * @param TranslationGuesser $translation
     */
    public function __construct(TranslationGuesser $translation)
    {
        $this->translation = $translation;
    }

    /**
     * Guess field definition parameters for the migration.
     *
     * @param Migration $migration
     */
    public function guess(Migration $migration)
    {
        $this->translation->guess($migration);
    }
}
