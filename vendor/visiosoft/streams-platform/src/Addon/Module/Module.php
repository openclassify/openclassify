<?php namespace Anomaly\Streams\Platform\Addon\Module;

use Anomaly\Streams\Platform\Addon\Addon;

/**
 * Class Module
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class Module extends Addon
{

    /**
     * The module's sections.
     *
     * @var string|array
     */
    protected $sections = [];

    /**
     * The module's shortcuts.
     *
     * @var string|array
     */
    protected $shortcuts = [];

    /**
     * The module's menu.
     *
     * @var string|array
     */
    protected $menu = [];

    /**
     * The module's icon.
     *
     * @var string
     */
    protected $icon = 'fa fa-puzzle-piece';

    /**
     * The navigation flag.
     *
     * @var bool
     */
    protected $navigation = true;

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
     * Get the module's tag class.
     *
     * @var string
     */
    protected $tag = 'Anomaly\Streams\Platform\Addon\Module\ModuleTag';

    /**
     * Get the module's sections.
     *
     * @return array
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * Set the sections.
     *
     * @param array $sections
     * @return $this
     */
    public function setSections($sections)
    {
        $this->sections = $sections;

        return $this;
    }

    /**
     * Add a section.
     *
     * @param        $slug
     * @param  array $section
     * @param null   $position
     * @return $this
     */
    public function addSection($slug, array $section, $position = null)
    {
        if ($position === null) {
            $position = count($this->sections) + 1;
        }

        $front = array_slice($this->sections, 0, $position, true);
        $back  = array_slice($this->sections, $position, count($this->sections) - $position, true);

        $this->sections = $front + [$slug => $section] + $back;

        return $this;
    }

    /**
     * Add a section button.
     *
     * @param        $section
     * @param        $slug
     * @param  array $button
     * @param null   $position
     * @return $this
     */
    public function addSectionButton($section, $slug, array $button, $position = null)
    {
        $buttons = (array)array_get($this->sections, "{$section}.buttons");

        if ($position === null) {
            $position = count($buttons) + 1;
        }

        $front = array_slice($buttons, 0, $position, true);
        $back  = array_slice($buttons, $position, count($buttons) - $position, true);

        $buttons = $front + [$slug => $button] + $back;

        array_set($this->sections, "{$section}.buttons", $buttons);

        return $this;
    }

    /**
     * Get the module's shortcuts.
     *
     * @return array
     */
    public function getShortcuts()
    {
        return $this->shortcuts;
    }

    /**
     * Set the shortcuts.
     *
     * @param array $shortcuts
     * @return $this
     */
    public function setShortcuts($shortcuts)
    {
        $this->shortcuts = $shortcuts;

        return $this;
    }

    /**
     * Add a shortcut.
     *
     * @param        $slug
     * @param  array $shortcut
     * @param null   $position
     * @return $this
     */
    public function addShortcut($slug, array $shortcut, $position = null)
    {
        if ($position === null) {
            $position = count($this->shortcuts) + 1;
        }

        $front = array_slice($this->shortcuts, 0, $position, true);
        $back  = array_slice($this->shortcuts, $position, count($this->shortcuts) - $position, true);

        $this->shortcuts = $front + [$slug => $shortcut] + $back;

        return $this;
    }

    /**
     * Get the module's menu.
     *
     * @return array|string
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Get the module's icon.
     *
     * @return string|null|false
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Get the navigation flag.
     *
     * @return bool
     */
    public function getNavigation()
    {
        return $this->navigation;
    }

    /**
     * Set the navigation flag.
     *
     * @param $navigation
     * @return $this
     */
    public function setNavigation($navigation)
    {
        $this->navigation = $navigation;

        return $this;
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
     * @return ModulePresenter
     */
    public function getPresenter()
    {
        return app()->make('Anomaly\Streams\Platform\Addon\Module\ModulePresenter', ['object' => $this]);
    }
}
