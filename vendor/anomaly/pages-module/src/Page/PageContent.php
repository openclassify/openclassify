<?php namespace Anomaly\PagesModule\Page;

use Anomaly\EditorFieldType\EditorFieldType;
use Anomaly\EditorFieldType\EditorFieldTypePresenter;
use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\Streams\Platform\Support\Template;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\View\Factory;
use Robbo\Presenter\Decorator;

/**
 * Class PageContent
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PageContent
{

    /**
     * The view factory.
     *
     * @var Factory
     */
    protected $view;

    /**
     * The template engine.
     *
     * @var Template
     */
    protected $template;

    /**
     * The response factory.
     *
     * @var ResponseFactory
     */
    protected $response;

    /**
     * The decorator utility.
     *
     * @var Decorator
     */
    protected $decorator;

    /**
     * Create a new PageContent instance.
     *
     * @param Factory $view
     * @param Template $template
     * @param Decorator $decorator
     * @param ResponseFactory $response
     */
    public function __construct(Factory $view, Template $template, Decorator $decorator, ResponseFactory $response)
    {
        $this->view      = $view;
        $this->template  = $template;
        $this->response  = $response;
        $this->decorator = $decorator;
    }

    /**
     * Make the view content.
     *
     * @param PageInterface $page
     */
    public function make(PageInterface $page)
    {
        $type = $page->getType();

        /* @var EditorFieldType $layout */
        /* @var EditorFieldTypePresenter $presenter */
        $layout    = $type->getFieldType('layout');
        $presenter = $type->getFieldTypePresenter('layout');

        $view = $layout->getViewPath();

        if (
            strpos($presenter->content(), '{% block') !== false &&
            strpos($presenter->content(), '{% extends') === false
        ) {
            $view = $this->template->make(
                '{% extends page.theme_layout.key ?: page.type.theme_layout.key %}' . $presenter->content()
            );
        }

        $page->setContent($this->view->make($view, compact('page'))->render());

        /**
         * If the type layout is taking the
         * reigns then allow it to do so.
         *
         * This will let layouts natively
         * extend parent view blocks.
         */
        if (
            strpos($presenter->content(), '{% extends') !== false ||
            strpos($presenter->content(), '{% block') !== false
        ) {

            $page->setResponse($this->response->make($page->getContent()));

            return;
        }
    }
}
