<?php namespace Anomaly\PostsModule\Type\Command;

use Anomaly\PostsModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Illuminate\Contracts\Config\Repository;


/**
 * Class CreateTypeStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class CreateTypeStream
{

    /**
     * The post type instance.
     *
     * @var TypeInterface
     */
    protected $type;

    /**
     * Create a new CreateTypeStream instance.
     *
     * @param TypeInterface $type
     */
    public function __construct(TypeInterface $type)
    {
        $this->type = $type;
    }

    /**
     * @param StreamRepositoryInterface $streams
     * @param Repository                $config
     */
    public function handle(StreamRepositoryInterface $streams, Repository $config)
    {
        $streams->create(
            [
                $config->get('app.fallback_locale') => [
                    'name'        => $this->type->getName(),
                    'description' => $this->type->getDescription(),
                ],
                'slug'                              => $this->type->getSlug() . '_posts',
                'namespace'                         => 'posts',
                'locked'                            => false,
                'translatable'                      => true,
                'trashable'                         => true,
                'hidden'                            => true,
            ]
        );
    }
}
