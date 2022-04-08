<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class SectionNormalizer
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SectionNormalizer
{

    /**
     * The module collection.
     *
     * @var ModuleCollection
     */
    protected $modules;

    /**
     * Create a new SectionNormalizer instance.
     *
     * @param ModuleCollection $modules
     */
    public function __construct(ModuleCollection $modules)
    {
        $this->modules = $modules;
    }

    /**
     * Normalize the section input.
     *
     * @param ControlPanelBuilder $builder
     */
    public function normalize(ControlPanelBuilder $builder)
    {
        $sections = $builder->getSections();

        /*
         * Move child sections into main array.
         */
        foreach ($sections as $slug => &$section) {
            if (isset($section['sections'])) {
                foreach ($section['sections'] as $key => $child) {

                    /**
                     * It's a slug only!
                     */
                    if (is_string($child)) {

                        $key = $child;

                        $child = ['slug' => $child];
                    }

                    $child['parent'] = array_get($section, 'slug', $slug);
                    $child['slug']   = array_get($child, 'slug', $key);

                    $sections[$key] = $child;
                }
            }
        }

        /*
         * Loop over each section and make sense of the input
         * provided for the given module.
         */
        foreach ($sections as $slug => &$section) {

            /*
             * If the slug is not valid and the section
             * is a string then use the section as the slug.
             */
            if (is_numeric($slug) && is_string($section)) {
                $section = [
                    'slug' => $section,
                ];
            }

            /*
             * If the slug is a string and the title is not
             * set then use the slug as the slug.
             */
            if (is_string($slug) && !isset($section['slug'])) {
                $section['slug'] = $slug;
            }

            /*
             * Make sure we have attributes.
             */
            $section['attributes'] = array_get($section, 'attributes', []);

            /*
             * Move the HREF into attributes.
             */
            if (isset($section['href'])) {
                $section['attributes']['href'] = array_pull($section, 'href');
            }

            /*
             * Move all data-* keys
             * to attributes.
             */
            foreach ($section as $attribute => $value) {
                if (str_is('data-*', $attribute)) {
                    array_set($section, 'attributes.' . $attribute, array_pull($section, $attribute));
                }
            }

            /*
             * Move the data-href into the permalink.
             *
             * @deprecated as of v3.2
             */
            if (!isset($section['permalink']) && isset($section['attributes']['data-href'])) {
                $section['permalink'] = array_pull($section, 'attributes.data-href');
            }

            /*
             * Make sure the HREF and permalink are absolute.
             */
            if (
                isset($section['attributes']['href']) &&
                is_string($section['attributes']['href']) &&
                !starts_with($section['attributes']['href'], 'http')
            ) {
                $section['attributes']['href'] = url($section['attributes']['href']);
            }

            if (
                isset($section['permalink']) &&
                is_string($section['permalink']) &&
                !starts_with($section['permalink'], 'http')
            ) {
                $section['permalink'] = url($section['permalink']);
            }
        }

        $builder->setSections(array_values($sections));
    }
}
