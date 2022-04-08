<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Action;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ActionNormalizer
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ActionNormalizer
{

    /**
     * Normalize action input.
     *
     * @param TableBuilder $builder
     */
    public function normalize(TableBuilder $builder)
    {
        $actions = $builder->getActions();
        $prefix  = $builder->getTableOption('prefix');

        foreach ($actions as $slug => &$action) {
            $action = $this->process($prefix, $slug, $action);
        }

        $builder->setActions($actions);
    }

    /**
     * Process the action.
     *
     * @param $prefix
     * @param $slug
     * @param $action
     * @return array
     */
    protected function process($prefix, $slug, $action)
    {
        /*
         * If the slug is numeric and the action is
         * a string then treat the string as both the
         * action and the slug. This is OK as long as
         * there are not multiple instances of this
         * input using the same action which is not likely.
         */
        if (is_numeric($slug) && is_string($action)) {
            $action = [
                'slug'   => $action,
                'action' => $action,
            ];
        }

        /*
         * If the slug is NOT numeric and the action is a
         * string then use the slug as the slug and the
         * action as the action.
         */
        if (!is_numeric($slug) && is_string($action)) {
            $action = [
                'slug'   => $slug,
                'action' => $action,
            ];
        }

        /*
         * If the slug is not numeric and the action is an
         * array without a slug then use the slug for
         * the slug for the action.
         */
        if (is_array($action) && !isset($action['slug']) && !is_numeric($slug)) {
            $action['slug'] = $slug;
        }

        /*
         * If the slug is not numeric and the action is an
         * array without a action then use the slug for
         * the action for the action.
         */
        if (is_array($action) && !isset($action['action']) && !is_numeric($slug)) {
            $action['action'] = $slug;
        }

        /*
         * Make sure the attributes array is set.
         */
        $action['attributes'] = array_get($action, 'attributes', []);

        /*
         * Move all data-* keys
         * to attributes.
         */
        foreach ($action as $attribute => $value) {
            if (str_is('data-*', $attribute)) {
                array_set($action, 'attributes.' . $attribute, array_pull($action, $attribute));
            }
        }

        /*
         * Move the URL/HREF if any to the attributes.
         */
        if (isset($action['url'])) {
            $action['attributes']['url'] = array_pull($action, 'url');
        }

        if (isset($action['href'])) {
            $action['attributes']['href'] = array_pull($action, 'href');
        }

        /*
         * Make sure the URL/HREF is absolute.
         */
        if (
            isset($action['attributes']['url']) &&
            is_string($action['attributes']['url']) &&
            !starts_with($action['attributes']['url'], ['http', '{'])
        ) {
            $action['attributes']['url'] = url($action['attributes']['url']);
        }

        if (
            isset($action['attributes']['href']) &&
            is_string($action['attributes']['href']) &&
            !starts_with($action['attributes']['href'], ['http', '{'])
        ) {
            $action['attributes']['href'] = url($action['attributes']['href']);
        }

        /*
         * Set defaults as expected for actions.
         */
        $action['size']     = array_get($action, 'small', 'sm');
        $action['disabled'] = array_get($action, 'disabled', array_get($action, 'toggle', true));

        $action['attributes']['name']  = $prefix . 'action';
        $action['attributes']['value'] = $action['slug'];

        // If not toggle add the ignore attribute.
        if (array_get($action, 'toggle', true) === false) {
            $action['attributes']['data-ignore'] = '';
        }

        if (isset($action['dropdown'])) {
            foreach ($action['dropdown'] as $key => &$dropdown) {
                $dropdown = $this->process($prefix, $key, $dropdown);
            }
        }

        return $action;
    }
}
