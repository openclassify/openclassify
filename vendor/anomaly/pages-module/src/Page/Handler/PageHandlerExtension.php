<?php namespace Anomaly\PagesModule\Page\Handler;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\PagesModule\Page\Handler\Contract\PageHandlerInterface;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Model\Pages\PagesPagesEntryTranslationsModel;

/**
 * Class PageHandlerExtension
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PageHandlerExtension extends Extension implements PageHandlerInterface
{

    /**
     * Make the page's response.
     *
     * @param PageInterface $page
     */
    public function make(PageInterface $page)
    {
        throw new \Exception('Implement make() method.');
    }

    /**
     * Return the page's route dump.
     *
     * @param PageInterface $page
     * @return null|string
     */
    public function route(PageInterface $page)
    {
        $translations = $page->getTranslations();

        /**
         * If the page is exact then
         * return it as is with no {any}.
         */
        if ($page->isExact()) {
            return implode(
                "\n\n",
                $translations->map(
                    function ($translation) use ($page) {

                        /**
                         * @var PageInterface|PagesPagesEntryTranslationsModel $translation
                         */
                        return "Route::any('{$translation->path}', [
    'uses'                       => 'Anomaly\\PagesModule\\Http\\Controller\\PagesController@view',
    'as'                         => 'pages::{$page->getId()}.{$translation->locale}',
    'streams::addon'             => 'anomaly.module.pages',
    'anomaly.module.pages::page' => {$page->getId()},
]);";
                    }
                )->all()
            );
        }

        /**
         * If the page is not exact
         * it must accommodate {any}.
         */
        if (!$page->isExact()&& !$page->isHome()) {
            return implode(
                "\n\n",
                $translations->map(
                    function ($translation) use ($page) {

                        /**
                         * @var PageInterface|PagesPagesEntryTranslationsModel $translation
                         */
                        return "Route::any('{$translation->path}/{any?}', [
    'uses'                       => 'Anomaly\\PagesModule\\Http\\Controller\\PagesController@view',
    'as'                         => 'pages::{$page->getId()}.{$translation->locale}',
    'streams::addon'             => 'anomaly.module.pages',
    'anomaly.module.pages::page' => {$page->getId()},
    'where'                      => [
        'any' => '(.*)',
    ],
]);";
                    }
                )->all()
            );
        }

        return null;
    }
}
