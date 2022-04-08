<?php namespace Anomaly\PagesModule\Page\Command;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\PagesModule\Page\PageTranslationsModel;

/**
 * Class SetPath
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetPath
{

    /**
     * The page translation instance.
     *
     * @var PageTranslationsModel
     */
    protected $translation;

    /**
     * Create a new SetPath instance.
     *
     * @param PageTranslationsModel $translation
     */
    public function __construct(PageTranslationsModel $translation)
    {
        $this->translation = $translation;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        /* @var PageInterface $page */
        $page = $this->translation->getParent();

        if ($parent = $page->getParent()) {
            $path = ($parent->isHome()
                    ? $parent->translate($this->translation->getLocale(), true)->slug
                    : $parent->translate($this->translation->getLocale(), true)->path
                ) . '/' . $this->translation->slug;
        } elseif ($page->isHome()) {
            $path = '/';
        } else {
            $path = '/' . $this->translation->slug;
        }

        $this->translation->setAttribute('path', $path);
    }
}
