<?php namespace Anomaly\PostsModule\Post;

use Anomaly\EditorFieldType\EditorFieldType;
use Anomaly\EditorFieldType\EditorFieldTypePresenter;
use Anomaly\PostsModule\Post\Contract\PostInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\View\Factory;
use Robbo\Presenter\Decorator;

/**
 * Class PostContent
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PostContent
{

    /**
     * The view factory.
     *
     * @var Factory
     */
    protected $view;

    /**
     * The decorator utility.
     *
     * @var Decorator
     */
    protected $decorator;

    /**
     * The response factory.
     *
     * @var ResponseFactory
     */
    protected $response;

    /**
     * Create a new PostContent instance.
     *
     * @param Factory         $view
     * @param Decorator       $decorator
     * @param ResponseFactory $response
     */
    public function __construct(Factory $view, Decorator $decorator, ResponseFactory $response)
    {
        $this->view      = $view;
        $this->decorator = $decorator;
        $this->response  = $response;
    }

    /**
     * Make the view content.
     *
     * @param PostInterface $p
     */
    public function make(PostInterface $post)
    {
        $type = $post->getType();

        /* @var EditorFieldType $layout */
        /* @var EditorFieldTypePresenter $presenter */
        $layout    = $type->getFieldType('layout');
        $presenter = $type->getFieldTypePresenter('layout');

        $post->setContent($this->view->make($layout->getViewPath(), compact('post'))->render());

        /**
         * If the type layout is taking the
         * reigns then allow it to do so.
         *
         * This will let layouts natively
         * extend parent view blocks.
         */
        if (strpos($presenter->content(), '{% extends') !== false) {
            $post->setResponse($this->response->make($post->getContent()));
        }
    }
}
