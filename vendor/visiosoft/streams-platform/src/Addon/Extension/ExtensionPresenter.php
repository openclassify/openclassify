<?php namespace Anomaly\Streams\Platform\Addon\Extension;

use Anomaly\Streams\Platform\Addon\AddonPresenter;

/**
 * Class ExtensionPresenter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ExtensionPresenter extends AddonPresenter
{

    /**
     * The decorated object.
     * This is for IDE hinting.
     *
     * @var Extension
     */
    protected $object;

    /**
     * Return the state wrapped in a label.
     *
     * @return string
     */
    public function stateLabel()
    {
        if ($this->object->isInstalled()) {
            return '<span class="label label-success">' . trans('streams::addon.installed') . '</span>';
        }

        return '<span class="label label-default">' . trans('streams::addon.uninstalled') . '</span>';
    }

    /**
     * Return the status wrapped in a label.
     *
     * @return string
     */
    public function statusLabel()
    {
        if ($this->object->isEnabled()) {
            return '<span class="label label-success">' . trans('streams::addon.enabled') . '</span>';
        }

        if ($this->object->isInstalled()) {
            return '<span class="label label-warning">' . trans('streams::addon.disabled') . '</span>';
        }
    }
}
