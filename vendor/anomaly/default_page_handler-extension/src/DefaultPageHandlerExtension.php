<?php namespace Anomaly\DefaultPageHandlerExtension;

use Anomaly\DefaultPageHandlerExtension\Command\MakePage;
use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\PagesModule\Page\Handler\PageHandlerExtension;

/**
 * Class DefaultPageHandlerExtension
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DefaultPageHandlerExtension extends PageHandlerExtension
{

    /**
     * This extension provides the default
     * page handler for the Pages module.
     *
     * @var string
     */
    protected $provides = 'anomaly.module.pages::handler.default';

    /**
     * Make the page's response.
     *
     * @param PageInterface $page
     */
    public function make(PageInterface $page)
    {
        $this->dispatch(new MakePage($page));
    }
}
