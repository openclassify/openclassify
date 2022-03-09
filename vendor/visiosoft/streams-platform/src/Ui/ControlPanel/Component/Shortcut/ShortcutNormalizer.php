<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Shortcut;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class ShortcutNormalizer
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ShortcutNormalizer
{

    /**
     * The module collection.
     *
     * @var ModuleCollection
     */
    protected $modules;

    /**
     * Create a new ShortcutNormalizer instance.
     *
     * @param ModuleCollection $modules
     */
    public function __construct(ModuleCollection $modules)
    {
        $this->modules = $modules;
    }

    /**
     * Normalize the shortcut input.
     *
     * @param ControlPanelBuilder $builder
     */
    public function normalize(ControlPanelBuilder $builder)
    {
        $shortcuts = $builder->getShortcuts();

        /*
         * Move child shortcuts into main array.
         */
        foreach ($shortcuts as $slug => &$shortcut) {
            if (isset($shortcut['shortcuts'])) {
                foreach ($shortcut['shortcuts'] as $key => $child) {

                    /**
                     * It's a slug only!
                     */
                    if (is_string($child)) {

                        $key = $child;

                        $child = ['slug' => $child];
                    }

                    $child['parent'] = array_get($shortcut, 'slug', $slug);
                    $child['slug']   = array_get($child, 'slug', $key);

                    $shortcuts[$key] = $child;
                }
            }
        }

        /*
         * Loop over each shortcut and make sense of the input
         * provided for the given module.
         */
        foreach ($shortcuts as $slug => &$shortcut) {

            /*
             * If the slug is not valid and the shortcut
             * is a string then use the shortcut as the slug.
             */
            if (is_numeric($slug) && is_string($shortcut)) {
                $shortcut = [
                    'slug' => $shortcut,
                ];
            }

            /*
             * If the slug is a string and the title is not
             * set then use the slug as the slug.
             */
            if (is_string($slug) && !isset($shortcut['slug'])) {
                $shortcut['slug'] = $slug;
            }

            /*
             * Make sure we have attributes.
             */
            $shortcut['attributes'] = array_get($shortcut, 'attributes', []);

            /*
             * Move the HREF into attributes.
             */
            if (isset($shortcut['href'])) {
                $shortcut['attributes']['href'] = array_pull($shortcut, 'href');
            }

            /*
             * Move all data-* keys
             * to attributes.
             */
            foreach ($shortcut as $attribute => $value) {
                if (str_is('data-*', $attribute)) {
                    array_set($shortcut, 'attributes.' . $attribute, array_pull($shortcut, $attribute));
                }
            }

            /*
             * Make sure the HREF and permalink are absolute.
             */
            if (
                isset($shortcut['attributes']['href']) &&
                is_string($shortcut['attributes']['href']) &&
                !starts_with($shortcut['attributes']['href'], 'http')
            ) {
                $shortcut['attributes']['href'] = url($shortcut['attributes']['href']);
            }

            /*
             * If we have a dropdown then
             * process those real quick.
             */
            if (isset($shortcut['dropdown'])) {

                foreach ($shortcut['dropdown'] as $index => &$dropdown) {

                    if (is_string($dropdown)) {
                        $dropdown = [
                            'text' => $index,
                            'href' => $dropdown,
                        ];
                    }

                    // Make sure we have attributes.
                    $dropdown['attributes'] = array_get($dropdown, 'attributes', []);

                    // Move the HREF if any to the attributes.
                    if (isset($dropdown['href'])) {
                        array_set($dropdown['attributes'], 'href', array_pull($dropdown, 'href'));
                    }

                    // Move the target if any to the attributes.
                    if (isset($dropdown['target'])) {
                        array_set($dropdown['attributes'], 'target', array_pull($dropdown, 'target'));
                    }

                    // Make sure the HREF is absolute.
                    if (
                        isset($dropdown['attributes']['href']) &&
                        is_string($dropdown['attributes']['href']) &&
                        !starts_with($dropdown['attributes']['href'], 'http')
                    ) {
                        $dropdown['attributes']['href'] = url($dropdown['attributes']['href']);
                    }
                }
            }
        }

        $builder->setShortcuts(array_values($shortcuts));
    }
}
