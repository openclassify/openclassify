<?php namespace Anomaly\Streams\Platform\Assignment\Contract;

use Anomaly\Streams\Platform\Assignment\AssignmentCollection;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Model\Contract\EloquentRepositoryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Interface AssignmentRepositoryInterface
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
interface AssignmentRepositoryInterface extends EloquentRepositoryInterface
{

    /**
     * Find an assignment by stream and field.
     *
     * @param  StreamInterface                        $stream
     * @param  FieldInterface                         $field
     * @return null|AssignmentInterface|EloquentModel
     */
    public function findByStreamAndField(StreamInterface $stream, FieldInterface $field);

    /**
     * Find all assignments by stream.
     *
     * @param  StreamInterface      $stream
     * @return AssignmentCollection
     */
    public function findByStream(StreamInterface $stream);

    /**
     * Clean up abandoned assignments.
     */
    public function cleanup();
}
