<?php namespace Anomaly\PostsModule\Post\Form\Command;

use Anomaly\PostsModule\Post\Form\PostEntryFormBuilder;
use Anomaly\PostsModule\Post\Form\PostFormBuilder;
use Anomaly\PostsModule\Type\Contract\TypeRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class AddPostFormFromRequest
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddPostFormFromRequest
{

    /**
     * The multiple form builder.
     *
     * @var PostEntryFormBuilder
     */
    protected $builder;

    /**
     * Create a new AddPostFormFromRequest instance.
     *
     * @param PostEntryFormBuilder $builder
     */
    public function __construct(PostEntryFormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param TypeRepositoryInterface $types
     * @param PostFormBuilder         $builder
     * @param Request                 $request
     */
    public function handle(TypeRepositoryInterface $types, PostFormBuilder $builder, Request $request)
    {
        $this->builder->addForm('post', $builder->setType($types->find($request->get('type'))));
    }
}
