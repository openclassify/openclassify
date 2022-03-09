<?php namespace Anomaly\BlocksModule\Type\Command;

use Anomaly\BlocksModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;


/**
 * Class GetStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetStream
{

    /**
     * The block type instance.
     *
     * @var TypeInterface
     */
    protected $type;

    /**
     * Create a new GetStream instance.
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
     * @param  StreamRepositoryInterface                                      $streams
     * @return \Anomaly\Streams\Platform\Stream\Contract\StreamInterface|null
     */
    public function handle(StreamRepositoryInterface $streams)
    {
        return $streams->findBySlugAndNamespace($this->type->getSlug() . '_blocks', 'blocks');
    }
}
