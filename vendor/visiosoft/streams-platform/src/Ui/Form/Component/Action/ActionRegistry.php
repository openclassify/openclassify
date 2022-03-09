<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Action;

/**
 * Class ActionRegistry
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class ActionRegistry
{

    /**
     * Available actions.
     *
     * @var array
     */
    protected $actions = [
        'update'         => [
            'button' => 'update',
            'text'   => 'streams::button.update',
        ],
        'save_exit'      => [
            'button' => 'save',
            'text'   => 'streams::button.save_exit',
        ],
        'save_edit'      => [
            'button' => 'save',
            'text'   => 'streams::button.save_edit',
        ],
        'save_create'    => [
            'button' => 'save',
            'text'   => 'streams::button.save_create',
        ],
        'save_continue'  => [
            'button' => 'save',
            'text'   => 'streams::button.save_continue',
        ],
        'save_edit_next' => [
            'button' => 'save',
            'text'   => 'streams::button.save_edit_next',
        ],
    ];

    /**
     * Get a action.
     *
     * @param  $action
     * @return array|null
     */
    public function get($action)
    {
        if (!$action) {
            return null;
        }

        return array_get($this->actions, $action);
    }

    /**
     * Register a action.
     *
     * @param        $action
     * @param  array $parameters
     * @return $this
     */
    public function register($action, array $parameters)
    {
        array_set($this->actions, $action, $parameters);

        return $this;
    }
}
