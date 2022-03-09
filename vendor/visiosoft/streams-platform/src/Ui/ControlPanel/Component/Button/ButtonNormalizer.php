<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Button;

use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class ButtonNormalizer
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ButtonNormalizer
{

    /**
     * Normalize button input.
     *
     * @param ControlPanelBuilder $builder
     */
    public function normalize(ControlPanelBuilder $builder)
    {
        $buttons = $builder->getButtons();

        foreach ($buttons as $key => &$button) {

            /*
             * If the button is a string but the key
             * is numeric then use the button as the
             * button type.
             */
            if (is_numeric($key) && is_string($button)) {
                $button = [
                    'button' => $button,
                ];
            }

            /*
             * If the button AND key are strings then
             * use the key as the button and the
             * button as the text parameters.
             */
            if (!is_numeric($key) && is_string($button)) {
                $button = [
                    'text'   => $button,
                    'button' => $key,
                ];
            }

            /*
             * If the key is not numeric and the button
             * is an array without the button key then
             * use the key as the button's type.
             */
            if (!is_numeric($key) && is_array($button) && !isset($button['button'])) {
                $button['button'] = $key;
            }

            /*
             * Make sure some default parameters exist.
             */
            $button['attributes'] = array_get($button, 'attributes', []);

            /*
             * Move the HREF if any to the attributes.
             */
            if (isset($button['href'])) {
                array_set($button['attributes'], 'href', array_pull($button, 'href'));
            }

            /*
             * Move the target if any to the attributes.
             */
            if (isset($button['target'])) {
                array_set($button['attributes'], 'target', array_pull($button, 'target'));
            }

            /*
             * Move all data-* keys
             * to attributes.
             */
            foreach ($button as $attribute => $value) {
                if (str_is('data-*', $attribute)) {
                    array_set($button, 'attributes.' . $attribute, array_pull($button, $attribute));
                }
            }

            /*
             * Make sure the HREF is absolute.
             */
            if (
                isset($button['attributes']['href']) &&
                is_string($button['attributes']['href']) &&
                !starts_with($button['attributes']['href'], 'http')
            ) {
                $button['attributes']['href'] = url($button['attributes']['href']);
            }

            /*
             * If we have a dropdown then
             * process those real quick.
             */
            if (isset($button['dropdown'])) {
                foreach ($button['dropdown'] as $index => &$dropdown) {
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

        $builder->setButtons($buttons);
    }
}
