<?php namespace Anomaly\PagesModule\Page\Command;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\PagesModule\Page\Contract\PageRepositoryInterface;
use Anomaly\PagesModule\Page\PageTranslationsModel;


/**
 * Class UpdatePaths
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UpdatePaths
{

    /**
     * The page translation instance.
     *
     * @var PageTranslationsModel
     */
    protected $translation;

    /**
     * Create a new UpdatePaths instance.
     *
     * @param PageTranslationsModel $translation
     */
    public function __construct(PageTranslationsModel $translation)
    {
        $this->translation = $translation;
    }

    /**
     * Handle the command.
     *
     * @param PageRepositoryInterface $pages
     */
    public function handle(PageRepositoryInterface $pages)
    {
        /* @var PageInterface $parent */
        $parent = $this->translation->getParent();

        foreach ($parent->getChildren() as $page) {
            if ($page instanceof PageInterface && $page->isLive()) {
                foreach ($page->getTranslations() as $translation) {
                    $pages->save($translation->setAttribute(
                        'path',
                        ($parent->isHome()
                            ? $parent->translateOrDefault($translation->getLocale())->slug
                            : $parent->translateOrDefault($translation->getLocale())->path
                        ) . '/' . $translation->slug
                    ));
                }
            }
        }
    }
}
