<?php namespace Anomaly\PagesModule\Page\Command;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\PagesModule\Page\Contract\PageRepositoryInterface;
use Anomaly\PagesModule\Page\PagePresenter;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\View\ViewTemplate;


/**
 * Class GetPage
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetPage
{

    /**
     * The identifier.
     *
     * @var mixed
     */
    protected $identifier;

    /**
     * Create a new GetPage instance.
     *
     * @param $identifier
     */
    public function __construct($identifier = null)
    {
        $this->identifier = $identifier;
    }

    /**
     * Handle the command.
     *
     * @param  PageRepositoryInterface          $pages
     * @param  ViewTemplate                     $template
     * @return PageInterface|EloquentModel|null
     */
    public function handle(PageRepositoryInterface $pages, ViewTemplate $template)
    {
        if (is_null($this->identifier)) {
            $this->identifier = $template->get('page');
        }

        if (is_numeric($this->identifier)) {
            return $pages->find($this->identifier);
        }

        if (is_string($this->identifier)) {
            return $pages->findByPath('/' . ltrim($this->identifier, '/'));
        }

        if ($this->identifier instanceof PageInterface) {
            return $this->identifier;
        }

        if ($this->identifier instanceof PagePresenter) {
            return $this->identifier->getObject();
        }

        return null;
    }
}
