<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Section;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

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
     * Normalize the sections.
     *
     * @param FormBuilder $builder
     */
    public function normalize(FormBuilder $builder)
    {
        $sections = $builder->getSections();

        foreach ($sections as $slug => &$section) {

            if (is_string($section)) {
                $section = [
                    'view' => $section,
                ];
            }

            /**
             * If tabs are defined but no orientation
             * then default to standard tabs.
             */
            if (isset($section['tabs']) && !isset($section['orientation'])) {
                $section['orientation'] = 'horizontal';
            }

            /*
             * Make sure some default parameters exist.
             */
            $section['attributes'] = array_get($section, 'attributes', []);

            /*
             * Move all data-* keys
             * to attributes.
             */
            foreach ($section as $attribute => $value) {
                if (str_is('data-*', $attribute)) {
                    array_set($section, 'attributes.' . $attribute, array_pull($section, $attribute));
                }
            }
        }

        $builder->setSections($sections);
    }
}
