<?php namespace Anomaly\PostsModule\Type\Command;

use Anomaly\PostsModule\Post\Contract\PostInterface;
use Anomaly\PostsModule\Post\Contract\PostRepositoryInterface;
use Anomaly\PostsModule\Type\Contract\TypeInterface;
use Anomaly\PostsModule\Type\Contract\TypeRepositoryInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdatePosts
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UpdatePosts
{

    use DispatchesJobs;

    /**
     * The post type instance.
     *
     * @var TypeInterface
     */
    protected $type;

    /**
     * Update a new UpdatePosts instance.
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
     * @param TypeRepositoryInterface $types
     * @param PostRepositoryInterface $posts
     */
    public function handle(TypeRepositoryInterface $types, PostRepositoryInterface $posts)
    {
        /* @var TypeInterface $type */
        if (!$type = $types->find($this->type->getId())) {
            return;
        }

        /* @var PostInterface $post */
        foreach ($type->getPosts() as $post) {
            $posts->save($post->setAttribute('entry_type', $this->type->getEntryModelName()));
        }
    }
}
