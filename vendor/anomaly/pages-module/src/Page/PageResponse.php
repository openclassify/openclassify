<?php namespace Anomaly\PagesModule\Page;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Illuminate\Routing\ResponseFactory;

/**
 * Class PageResponse
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PageResponse
{

    /**
     * The response factory.
     *
     * @var ResponseFactory
     */
    protected $container;

    /**
     * Create a new PageResponse instance.
     *
     * @param ResponseFactory $response
     */
    function __construct(ResponseFactory $response)
    {
        $this->response = $response;
    }

    /**
     * Make the page response.
     *
     * @param PageInterface $page
     */
    public function make(PageInterface $page)
    {
        if (!$page->getResponse()) {

            $response = $this->response->view(
                'anomaly.module.pages::page',
                [
                    'page'    => $page,
                    'content' => $page->getContent(),
                ]
            );

            if (!$page->isLive()) {
                $response->setTtl(0);
            }

            $page->setResponse($response);
        }
    }
}
