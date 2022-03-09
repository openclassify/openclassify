<?php namespace Anomaly\PostsModule\Http\Controller;

use Anomaly\PostsModule\Post\Command\AddPostsBreadcrumb;
use Anomaly\PostsModule\Type\Command\AddTypeBreadcrumb;
use Anomaly\PostsModule\Type\Command\AddTypeMetadata;
use Anomaly\PostsModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;

/**
 * Class TypesController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class TypesController extends PublicController
{

    /**
     * Return an index of type posts.
     *
     * @param  TypeRepositoryInterface     $types
     * @param                              $type
     * @return \Illuminate\View\View
     */
    public function index(TypeRepositoryInterface $types, $type)
    {
        if (!$type = $types->findBySlug($type)) {
            abort(404);
        }

        $this->dispatch(new AddPostsBreadcrumb());
        $this->dispatch(new AddTypeBreadcrumb($type));
        $this->dispatch(new AddTypeMetadata($type));

        return $this->view->make('anomaly.module.posts::types/index', compact('type'));
    }
}
