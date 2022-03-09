<?php namespace Anomaly\Streams\Platform\Database\Seeder;

use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;

class Seeder extends \Illuminate\Database\Seeder
{

    /**
     * The field repository.
     *
     * @var FieldRepositoryInterface $fields
     */
    protected $fields;

    /**
     * The stream repository.
     *
     * @var StreamRepositoryInterface $streams
     */
    protected $streams;

    /**
     * The assignment repository.
     *
     * @var AssignmentRepositoryInterface $assignments
     */
    protected $assignments;

    /**
     * Create a new Seeder instance.
     */
    public function __construct()
    {
        $this->fields      = app(FieldRepositoryInterface::class);
        $this->streams     = app(StreamRepositoryInterface::class);
        $this->assignments = app(AssignmentRepositoryInterface::class);
    }
}
