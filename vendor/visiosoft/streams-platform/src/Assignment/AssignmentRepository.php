<?php namespace Anomaly\Streams\Platform\Assignment;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Model\EloquentRepository;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class AssignmentRepository
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AssignmentRepository extends EloquentRepository implements AssignmentRepositoryInterface
{

    /**
     * The assignment model.
     *
     * @var AssignmentModel
     */
    protected $model;

    /**
     * Create a new AssignmentRepository interface.
     *
     * @param AssignmentModel $model
     */
    public function __construct(AssignmentModel $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new assignment.
     *
     * @param  array $attributes
     * @return AssignmentInterface
     */
    public function create(array $attributes = [])
    {
        array_set(
            $attributes,
            'sort_order',
            array_get(
                $attributes,
                'sort_order',
                $this->model->count('id') + 1
            )
        );

        return $this->model->create($attributes);
    }

    /**
     * Find an assignment by stream and field.
     *
     * @param  StreamInterface $stream
     * @param  FieldInterface  $field
     * @return null|AssignmentInterface|EloquentModel
     */
    public function findByStreamAndField(
        StreamInterface $stream,
        FieldInterface $field
    )
    {
        return $this->model
            ->where('stream_id', $stream->getId())
            ->where('field_id', $field->getId())
            ->first();
    }

    /**
     * Find all assignments by stream.
     *
     * @param  StreamInterface $stream
     * @return AssignmentCollection
     */
    public function findByStream(StreamInterface $stream)
    {
        return $this->model->where('stream_id', $stream->getId())->get();
    }

    /**
     * Clean up abandoned assignments.
     */
    public function cleanup()
    {
        $assignments = $this->model
            ->select('streams_assignments.*')
            ->leftJoin(
                'streams_streams',
                'streams_assignments.stream_id',
                '=',
                'streams_streams.id'
            )
            ->leftJoin(
                'streams_fields',
                'streams_assignments.field_id',
                '=',
                'streams_fields.id'
            )
            ->whereNull('streams_streams.id')
            ->orWhereNull('streams_fields.id')
            ->get();

        foreach ($assignments as $assignment) {
            $this->delete($assignment);
        }

        $translations = $this->model->getTranslationModel();

        $translations = $translations
            ->select('streams_assignments.*')
            ->leftJoin(
                'streams_assignments',
                'streams_assignments_translations.assignment_id',
                '=',
                'streams_assignments.id'
            )
            ->whereNull('streams_assignments.id')
            ->get();

        foreach ($translations as $translation) {
            $this->delete($translation);
        }
    }
}
