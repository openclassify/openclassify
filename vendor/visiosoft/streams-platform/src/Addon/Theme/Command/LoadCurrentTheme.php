<?php namespace Anomaly\Streams\Platform\Addon\Theme\Command;

use Anomaly\Streams\Platform\Addon\AddonProvider;
use Anomaly\Streams\Platform\Addon\Theme\ThemeCollection;
use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Asset\Asset;
use Anomaly\Streams\Platform\Image\Image;
use Anomaly\Streams\Platform\View\ViewTemplate;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;

/**
 * Class LoadCurrentTheme
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class LoadCurrentTheme
{

    /**
     * Create a new LoadCurrentTheme instance.
     *
     * @param Asset $asset
     * @param Image $image
     * @param Factory $view
     * @param Request $request
     * @param Repository $config
     * @param ThemeCollection $themes
     * @param ViewTemplate $template
     * @param Application $application
     * @param AddonProvider $provider
     */
    public function handle(
        Asset $asset,
        Image $image,
        Factory $view,
        Request $request,
        Repository $config,
        ThemeCollection $themes,
        ViewTemplate $template,
        Application $application,
        AddonProvider $provider
    ) {
        $admin    = $themes->get($config->get('streams::themes.admin'));
        $standard = $themes->get($config->get('streams::themes.standard'));

        if ($admin) {

            $admin->setActive(true);

            $provider->register($admin);
        }

        if ($standard) {

            $standard->setActive(true);

            $provider->register($standard);
        }

        $provider->boot();

        if ($admin && in_array($request->segment(1), ['installer', 'admin'])) {
            $admin->setCurrent(true);
        } elseif ($standard) {
            $standard->setCurrent(true);
        }

        if ($theme = $themes->current()) {
            $view->addNamespace(
                'theme',
                [
                    $application->getResourcesPath(
                        "addons/{$theme->getVendor()}/{$theme->getSlug()}-{$theme->getType()}/views/"
                    ),
                    $theme->getPath('resources/views'),
                ]
            );
            trans()->addNamespace('theme', $theme->getPath('resources/lang'));

            $asset->addPath('theme', $theme->getPath('resources'));
            $image->addPath('theme', $theme->getPath('resources'));

            /**
             * Add the theme to the view template
             * so it can be easily accessed later.
             */
            $template->set('theme', $theme);
        }
    }
}
