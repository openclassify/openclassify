<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Button;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class ButtonNormalizer
 *

 * @package       Anomaly\Streams\Platform\Ui\Button
 */
class ButtonNormalizer
{

    /**
     * Normalize button input.
     *
     * @param EntityBuilder $builder
     */
    public function normalize(EntityBuilder $builder)
    {
        $buttons = $builder->getButtons();

        foreach ($buttons as $key => &$button) {

            /**
             * If the button is a string then use
             * it as the button parameter.
             */
            if (is_string($button)) {
                $button = [
                    'button' => $button,
                ];
            }

            /**
             * If the key is a string and the button
             * is an array without a button param then
             * move the key into the button as that param.
             */
            if (!is_integer($key) && !isset($button['button'])) {
                $button['button'] = $key;
            }

            /**
             * Make sure some default parameters exist.
             */
            $button['attributes'] = array_get($button, 'attributes', []);

            /**
             * Move the HREF if any to the attributes.
             */
            if (isset($button['href'])) {
                array_set($button['attributes'], 'href', array_pull($button, 'href'));
            }

            /**
             * Move the target if any to the attributes.
             */
            if (isset($button['target'])) {
                array_set($button['attributes'], 'target', array_pull($button, 'target'));
            }

            /**
             * Move all data-* keys
             * to attributes.
             */
            foreach ($button as $attribute => $value) {
                if (str_is('data-*', $attribute)) {
                    array_set($button, 'attributes.' . $attribute, array_pull($button, $attribute));
                }
            }

            /**
             * Make sure the HREF is absolute.
             */
            if (
                isset($button['attributes']['href']) &&
                is_string($button['attributes']['href']) &&
                !starts_with($button['attributes']['href'], 'http')
            ) {
                $button['attributes']['href'] = url($button['attributes']['href']);
            }

            /**
             * Normalize dropdown input.
             */
            if ($dropdown = array_get($button, 'dropdown', [])) {

                foreach ($dropdown as $linkKey => &$link) {

                    /**
                     * If the dropdown is a string then
                     * use them for the HREF and text.
                     */
                    if (is_string($link)) {
                        $link = [
                            'text' => $link,
                            'href' => $linkKey,
                        ];
                    }

                    /**
                     * Move the HREF if any to the attributes.
                     */
                    if (isset($link['href'])) {
                        array_set($link['attributes'], 'href', array_pull($link, 'href'));
                    }

                    /**
                     * Move the target if any to the attributes.
                     */
                    if (isset($link['target'])) {
                        array_set($link['attributes'], 'target', array_pull($link, 'target'));
                    }

                    /**
                     * Move all data-* keys to attributes.
                     */
                    foreach (array_get($link, 'attributes', []) as $attribute => $value) {
                        if (str_is('data-*', $attribute)) {
                            array_set($link, 'attributes.' . $attribute, array_pull($link, $attribute));
                        }
                    }

                    /**
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

                $button['dropdown'] = array_values($dropdown);
            }
        }

        $builder->setButtons($buttons);
    }
}
