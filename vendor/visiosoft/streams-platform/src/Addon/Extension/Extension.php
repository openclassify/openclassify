<?php namespace Anomaly\Streams\Platform\Addon\Extension;

use Anomaly\Streams\Platform\Addon\Addon;

/**
 * Class Extension
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class Extension extends Addon
{

    /**
     * The provides string.
     *
     * @var null|string
     */
    protected $provides = null;

    /**
     * The installed flag.
     *
     * @var bool
     */
    protected $installed = false;

    /**
     * The enabled flag.
     *
     * @var bool
     */
    protected $enabled = false;

    /**
     * The active flag.
     *
     * @var bool
     */
    protected $active = false;

    /**
     * Set the provides string.
     *
     * @param $provides
     * @return $this
     */
    public function setProvides($provides)
    {
        $this->provides = $provides;

        return $this;
    }

    /**
     * Get the provides string.
     *
     * @return null|string
     */
    public function getProvides()
    {
        return $this->provides;
    }

    /**
     * Set the installed flag.
     *
     * @param  $installed
     * @return $this
     */
    public function setInstalled($installed)
    {
        $this->installed = $installed;

        return $this;
    }

    /**
     * Get the installed flag.
     *
     * @return bool
     */
    public function isInstalled()
    {
        return $this->installed;
    }

    /**
     * Set the enabled flag.
     *
     * @param  $enabled
     * @return $this
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get the enabled flag.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled && $this->installed;
    }

    /**
     * Set the active flag.
     *
     * @param  $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get the active flag.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Get the module's presenter.
     *
     * @return ExtensionPresenter
     */
    public function getPresenter()
    {
        return app()->make('Anomaly\Streams\Platform\Addon\Extension\ExtensionPresenter', ['object' => $this]);
    }
}
