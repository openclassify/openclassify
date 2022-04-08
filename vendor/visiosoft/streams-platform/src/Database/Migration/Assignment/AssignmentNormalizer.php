<?php namespace Anomaly\Streams\Platform\Database\Migration\Assignment;

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Illuminate\Contracts\Config\Repository;

class AssignmentNormalizer
{
    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * Create a new AssignmentInput instance.
     *
     * @param Repository $config
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * Normalize the assignments input.
     *
     * @param Migration $migration
     */
    public function normalize(Migration $migration)
    {
        $locale = $this->config->get('app.fallback_locale');

        $stream      = $migration->getStream();
        $assignments = $migration->getAssignments();

        foreach ($assignments as $field => &$assignment) {

            /*
             * If the assignment is a simple string
             * then the assignment is the field slug.
             */
            if (is_string($assignment)) {
                $assignment = [
                    'field' => $assignment,
                ];
            }

            /*
             * Generally the field will be the
             * array key. Make sure we have one.
             */
            if (!isset($assignment['field'])) {
                $assignment['field'] = $field;
            }

            /*
             * If any of the translatable items exist
             * in the base array then move them up into
             * the translation array.
             */
            foreach (['label', 'warning', 'instructions', 'placeholder'] as $key) {
                if ($value = array_pull($assignment, $key)) {
                    $assignment = array_add($assignment, $locale . '.' . $key, $value);
                }
            }
        }

        $migration->setAssignments($assignments);
    }
}
