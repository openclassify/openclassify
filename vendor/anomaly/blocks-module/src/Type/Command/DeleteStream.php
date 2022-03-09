<?php namespace Anomaly\BlocksModule\Type\Command;

use Anomaly\BlocksModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;


/**
 * Class DeleteStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DeleteStream
{

    /**
     * The block type instance.
     *
     * @var TypeInterface
     */
    protected $type;

    /**
     * Create a new DeleteStream instance.
     *
     * @param TypeInterface $type
     */
    public function __construct(TypeInterface $type)
    {
        $this->type = $type;
    }

    /**
     * Handle the command.
     *
     * @param StreamRepositoryInterface $streams
     */
    public function handle(StreamRepositoryInterface $streams)
    {
        if (!$this->type->isForceDeleting()) {
            return;
        }
        
        $streams->delete($streams->findBySlugAndNamespace($this->type->getSlug() . '_blocks', 'blocks'));
    }
}
