<?php namespace Anomaly\PostsModule\Post\Form\Command;

use Anomaly\PostsModule\Post\Contract\PostInterface;
use Anomaly\PostsModule\Post\Form\PostEntryFormBuilder;
use Anomaly\PostsModule\Post\Form\PostFormBuilder;
use Anomaly\PostsModule\Type\Contract\TypeInterface;
use Anomaly\PostsModule\Type\Contract\TypeRepositoryInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class AddPostFormFromPost
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddPostFormFromPost
{

    use DispatchesJobs;

    /**
     * The multiple form builder.
     *
     * @var PostEntryFormBuilder
     */
    protected $builder;

    /**
     * The post instance.
     *
     * @var PostInterface
     */
    protected $post;

    /**
     * Create a new AddPostFormFromPost instance.
     *
     * @param PostEntryFormBuilder $builder
     * @param PostInterface $post
     */
    public function __construct(PostEntryFormBuilder $builder, PostInterface $post)
    {
        $this->builder = $builder;
        $this->post    = $post;
    }

    /**
     * Handle the command.
     *
     * @param PostFormBuilder $builder
     * @param TypeRepositoryInterface $types
     */
    public function handle(PostFormBuilder $builder, TypeRepositoryInterface $types)
    {
        $builder->setEntry($this->post);

        if (request()->has('type')) {

            /* @var TypeInterface $type */
            $type = $types->find(request('type'));

            $builder->setType($type);
        }

        $this->builder->addForm('post', $builder);
    }
}
