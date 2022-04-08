<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Button;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

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
     * @param TableBuilder $builder
     */
    public function normalize(TableBuilder $builder)
    {
        $buttons = $builder->getButtons();

        foreach ($buttons as $key => &$button) {
            $button = $this->process($key, $button);
        }

        $builder->setButtons($buttons);
    }

    /**
     * Process the button.
     *
     * @param $key
     * @param $button
     * @return array
     */
    protected function process($key, $button)
    {
        /*
         * If the button is a string and
         * the key is an integer then use
         * as the button and slug parameter.
         */
        if (is_integer($key) && is_string($button)) {
            $button = [
                'slug'   => $button,
                'button' => $button,
            ];
        }

        /*
         * If the button is a string and
         * the key is NOT an integer then use
         * it as the button parameter only.
         */
        if (!is_integer($key) && is_string($button)) {
            $button = [
                'button' => $button,
            ];
        }

        /*
         * If the key is a string and the button
         * is an array without a button param then
         * move the key into the button as that param.
         */
        if (!is_integer($key) && !isset($button['button'])) {
            $button['button'] = $key;
        }

        /*
         * If the key is a string and the button
         * is an array without a slug param then
         * move the key into the button as that param.
         */
        if (!is_integer($key) && !isset($button['slug'])) {
            $button['slug'] = $key;
        }

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
            !starts_with($button['attributes']['href'], ['http', '{'])
        ) {
            $button['attributes']['href'] = url($button['attributes']['href']);
        }

        /*
         * Use small buttons for tables.
         */
        $button['size'] = array_get($button, 'size', 'sm');

        if (isset($button['dropdown'])) {
            foreach ($button['dropdown'] as $key => &$dropdown) {
                $dropdown = $this->process($key, $dropdown);
            }
        }

        return $button;
    }
}
