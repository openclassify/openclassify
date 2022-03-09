<?php namespace Anomaly\Streams\Platform\Database\Migration\Assignment;

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Anomaly\Streams\Platform\Database\Migration\Assignment\AssignmentGuesser;
use Anomaly\Streams\Platform\Database\Migration\Assignment\AssignmentNormalizer;
use Illuminate\Contracts\Config\Repository;

class AssignmentInput
{

    /**
     * The assignment guesser.
     *
     * @var AssignmentGuesser
     */
    protected $guesser;

    /**
     * The assignment normalizer.
     *
     * @var AssignmentNormalizer
     */
    protected $normalizer;

    /**
     * Create a new AssignmentInput instance.
     *
     * @param AssignmentGuesser    $guesser
     * @param AssignmentNormalizer $normalizer
     */
    public function __construct(AssignmentGuesser $guesser, AssignmentNormalizer $normalizer)
    {
        $this->guesser    = $guesser;
        $this->normalizer = $normalizer;
    }

    /**
     * Read the assignments input.
     *
     * @param Migration $migration
     */
    public function read(Migration $migration)
    {
        $this->normalizer->normalize($migration);
        $this->guesser->guess($migration);
    }
}
