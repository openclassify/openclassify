<?php namespace Anomaly\PostsModule\Post\Form\Command;

use Anomaly\PostsModule\Entry\Form\EntryFormBuilder;
use Anomaly\PostsModule\Post\Contract\PostInterface;
use Anomaly\PostsModule\Post\Form\PostEntryFormBuilder;
use Anomaly\PostsModule\Type\Contract\TypeRepositoryInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class AddEntryFormFromPost
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddEntryFormFromPost
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
     * Create a new AddEntryFormFromPost instance.
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
     * @param EntryFormBuilder $builder
     * @param TypeRepositoryInterface $types
     */
    public function handle(EntryFormBuilder $builder, TypeRepositoryInterface $types)
    {
        $type = $this->post->getType();

        if (request()->has('type')) {

            $type = $types->find(request('type'));

            $this->builder->setOption('redirect', 'admin/posts/edit/' . $this->post->getId());
        }

        $builder->setOption('locking_enabled', false);

        $builder->setModel($type->getEntryModelName());
        $builder->setEntry($this->post->getEntryId());

        $this->builder->addForm('entry', $builder);
    }
}
