<?php namespace Anomaly\PagesModule\Type\Command;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\PagesModule\Page\Contract\PageRepositoryInterface;
use Anomaly\PagesModule\Type\Contract\TypeInterface;
use Anomaly\PagesModule\Type\Contract\TypeRepositoryInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdatePages
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UpdatePages
{

    use DispatchesJobs;

    /**
     * The page type instance.
     *
     * @var TypeInterface
     */
    protected $type;

    /**
     * Update a new UpdatePages instance.
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
     * @param PageRepositoryInterface $pages
     */
    public function handle(TypeRepositoryInterface $types, PageRepositoryInterface $pages)
    {
        /* @var TypeInterface $type */
        if (!$type = $types->find($this->type->getId())) {
            return;
        }

        /* @var PageInterface $page */
        foreach ($type->getPages() as $page) {
            $pages->save($page->setAttribute('entry_type', $this->type->getEntryModelName()));
        }
    }
}
