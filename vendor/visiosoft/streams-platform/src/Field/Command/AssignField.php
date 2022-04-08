<?php namespace Anomaly\Streams\Platform\Field\Command;

use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;

class AssignField
{

    /**
     * The field we're assigning.
     *
     * @var FieldInterface
     */
    protected $field;

    /**
     * The stream to assign to.
     *
     * @var StreamInterface
     */
    protected $stream;

    /**
     * The assignment attributes.
     *
     * @var array
     */
    protected $attributes;

    /**
     * Create a new AutoAssignField instance.
     *
     * @param FieldInterface  $field
     * @param StreamInterface $stream
     * @param array           $attributes
     */
    public function __construct(FieldInterface $field, StreamInterface $stream, array $attributes)
    {
        $this->field      = $field;
        $this->stream     = $stream;
        $this->attributes = $attributes;
    }

    /**
     * Handle the command.
     *
     * @param  AssignmentRepositoryInterface $assignments
     * @return AssignmentInterface
     */
    public function handle(AssignmentRepositoryInterface $assignments)
    {
        return $assignments->create($this->stream, $this->field, $this->attributes);
    }
}
