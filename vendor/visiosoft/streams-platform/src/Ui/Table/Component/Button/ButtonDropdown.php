<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Button;

use Anomaly\Streams\Platform\Support\Authorizer;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ButtonDropdown
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ButtonDropdown
{

    /**
     * Flatten the dropdowns
     *
     * @param TableBuilder $builder
     */
    public function flatten(TableBuilder $builder)
    {
        $buttons = $builder->getButtons();

        foreach ($buttons as $key => &$button) {

            if (isset($button['dropdown'])) {

                $button['position'] = 'right';

                foreach (array_pull($button, 'dropdown') as $dropdown) {

                    $dropdown['parent'] = $button['button'];

                    $buttons[$dropdown['slug']] = $dropdown;
                }
            }
        }

        $builder->setButtons($buttons);
    }

    /**
     * Build dropdown items.
     *
     * @param TableBuilder $builder
     */
    public function build(TableBuilder $builder)
    {
        $buttons = $builder->getButtons();
        $authorizer = resolve(Authorizer::class);

        foreach ($buttons as $key => &$button) {
            if (isset($button['permission']) && !$authorizer->authorize($button['permission'])) {
                // We don't have permission to use this button so hide it
                continue;
            }

            if ($dropdown = array_get($button, 'parent')) {
                foreach ($buttons as &$parent) {
                    if (array_get($parent, 'button') == $dropdown) {
                        if (!isset($parent['dropdown'])) {
                            $parent['dropdown'] = [];
                        }

                        $parent['dropdown'][] = $button;
                    }
                }
            }
        }

        $builder->setButtons($buttons);
    }
}
