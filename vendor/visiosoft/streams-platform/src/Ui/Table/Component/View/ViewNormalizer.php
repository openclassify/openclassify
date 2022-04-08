<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\View;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ViewNormalizer
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ViewNormalizer
{

    /**
     * Normalize the view input.
     *
     * @param TableBuilder $builder
     */
    public function normalize(TableBuilder $builder)
    {
        $views = $builder->getViews();

        foreach ($views as $slug => &$view) {

            /*
             * If the slug is numeric and the view is
             * a string then treat the string as both the
             * view and the slug. This is OK as long as
             * there are not multiple instances of this
             * input using the same view which is not likely.
             */
            if (is_numeric($slug) && is_string($view)) {
                $view = [
                    'slug' => $view,
                    'view' => $view,
                ];
            }

            /*
             * If the slug is NOT numeric and the view is a
             * string then use the slug as the slug and the
             * view as the view.
             */
            if (!is_numeric($slug) && is_string($view)) {
                $view = [
                    'slug' => $slug,
                    'view' => $view,
                ];
            }

            /*
             * If the slug is not numeric and the view is an
             * array without a slug then use the slug for
             * the slug for the view.
             */
            if (is_array($view) && !isset($view['slug']) && !is_numeric($slug)) {
                $view['slug'] = $slug;
            }

            /*
             * Make sure we have a view property.
             */
            if (is_array($view) && !isset($view['view'])) {
                $view['view'] = $view['slug'];
            }

            /*
             * Make sure some default parameters exist.
             */
            $view['attributes'] = array_get($view, 'attributes', []);

            /*
             * Move the HREF if any to the attributes.
             */
            if (isset($view['href'])) {
                array_set($view['attributes'], 'href', array_pull($view, 'href'));
            }

            /*
             * Move the target if any to the attributes.
             */
            if (isset($view['target'])) {
                array_set($view['attributes'], 'target', array_pull($view, 'target'));
            }

            /*
             * Make sure the HREF is absolute.
             */
            if (
                isset($view['attributes']['href']) &&
                is_string($view['attributes']['href']) &&
                !starts_with($view['attributes']['href'], 'http')
            ) {
                $view['attributes']['href'] = url($view['attributes']['href']);
            }
        }

        $builder->setViews($views);
    }
}
