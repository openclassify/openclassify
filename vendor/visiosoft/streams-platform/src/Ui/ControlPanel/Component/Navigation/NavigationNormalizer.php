<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation;

use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class NavigationNormalizer
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class NavigationNormalizer
{

    /**
     * Normalize the navigation input.
     *
     * @param ControlPanelBuilder $builder
     */
    public function normalize(ControlPanelBuilder $builder)
    {
        $links = $builder->getNavigation();

        foreach ($links as $path => &$link) {

            /*
             * If the link is a string
             * then it must be in the
             * $path => $title format.
             */
            if (is_string($link)) {
                $link = [
                    'href' => $path,
                ];
            }

            /*
             * Make sure we have attributes.
             */
            $link['attributes'] = array_get($link, 'attributes', []);

            /*
             * Move the HREF into attributes.
             */
            if (isset($link['href'])) {
                $link['attributes']['href'] = array_pull($link, 'href');
            }

            /*
             * Move all data-* keys
             * to attributes.
             */
            foreach ($link as $attribute => $value) {
                if (str_is('data-*', $attribute)) {
                    array_set($link, 'attributes.' . $attribute, array_pull($link, $attribute));
                }
            }

            /*
             * Make sure the HREF is absolute.
             */
            if (
                isset($link['attributes']['href']) &&
                is_string($link['attributes']['href']) &&
                !starts_with($link['attributes']['href'], 'http')
            ) {
                $link['attributes']['href'] = url($link['attributes']['href']);
            }
        }

        $builder->setNavigation($links);
    }
}
