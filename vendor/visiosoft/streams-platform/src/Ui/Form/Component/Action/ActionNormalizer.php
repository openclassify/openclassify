<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Action;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

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
     * @param FormBuilder $builder
     */
    public function normalize(FormBuilder $builder)
    {
        $form    = $builder->getForm();
        $actions = $builder->getActions();

        $prefix = $form->getOption('prefix');

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

        /**
         * Default to size "sm"
         */
        if (!isset($action['size'])) {
            $action['size'] = 'sm';
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
         * If the HREF is present outside of the attributes
         * then pull it and put it in the attributes array.
         */
        if (isset($action['url'])) {
            $action['attributes']['url'] = array_pull($action, 'url');
        }

        /*
         * Make sure the HREF is absolute.
         */
        if (
            isset($action['redirect']) &&
            is_string($action['redirect']) &&
            !starts_with($action['redirect'], ['http', '{url.'])
        ) {
            $action['redirect'] = url($action['redirect']);
        }

        $action['attributes']['name']  = $prefix . 'action';
        $action['attributes']['value'] = $action['slug'];
        $action['attributes']['type']  = 'submit';

        if (isset($action['dropdown'])) {
            foreach ($action['dropdown'] as $key => &$dropdown) {
                $dropdown = $this->process($prefix, $key, $dropdown);
            }
        }

        return $action;
    }
}
