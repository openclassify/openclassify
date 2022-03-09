<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel;

use Anomaly\Streams\Platform\Traits\FiresCallbacks;
use Anomaly\Streams\Platform\Ui\ControlPanel\Command\BuildControlPanel;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Button\ButtonHandler;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\NavigationHandler;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\SectionHandler;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Shortcut\ShortcutHandler;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class ControlPanelBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ControlPanelBuilder
{

    use DispatchesJobs;
    use FiresCallbacks;

    /**
     * The section buttons.
     *
     * @var array
     */
    protected $buttons = ButtonHandler::class;

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = SectionHandler::class;

    /**
     * The shortcut components.
     *
     * @var array
     */
    protected $shortcuts = ShortcutHandler::class;

    /**
     * The navigation links.
     *
     * @var array
     */
    protected $navigation = NavigationHandler::class;

    /**
     * The control_panel object.
     *
     * @var ControlPanel
     */
    protected $controlPanel;

    /**
     * Create a new ControlPanelBuilder instance.
     *
     * @param ControlPanel $controlPanel
     */
    public function __construct(ControlPanel $controlPanel)
    {
        $this->controlPanel = $controlPanel;
    }

    /**
     * Build the control_panel.
     */
    public function build()
    {
        $this->fire('ready', ['builder' => $this]);

        $this->dispatchNow(new BuildControlPanel($this));

        $this->fire('built', ['builder' => $this]);

        return $this->controlPanel;
    }

    /**
     * Get the control_panel.
     *
     * @return ControlPanel
     */
    public function getControlPanel()
    {
        return $this->controlPanel;
    }

    /**
     * Get the section buttons.
     *
     * @return array
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     * Set the section buttons.
     *
     * @param array $buttons
     */
    public function setButtons($buttons)
    {
        $this->buttons = $buttons;
    }

    /**
     * Get the module sections.
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
     * Get the module navigation.
     *
     * @return array
     */
    public function getNavigation()
    {
        return $this->navigation;
    }

    /**
     * Set the navigation.
     *
     * @param array $navigation
     */
    public function setNavigation($navigation)
    {
        $this->navigation = $navigation;
    }

    /**
     * Add a navigation item.
     *
     * @param        $slug
     * @param  array $section
     * @param null   $position
     * @return $this
     */
    public function addNavigation($slug, array $item, $position = null)
    {
        if ($position === null) {
            $position = count($this->navigation) + 1;
        }

        $front = array_slice($this->navigation, 0, $position, true);
        $back  = array_slice($this->navigation, $position, count($this->navigation) - $position, true);

        $this->navigation = $front + [$slug => $item] + $back;

        return $this;
    }

    /**
     * Return the active control panel section.
     *
     * @return Component\Section\Contract\SectionInterface|null
     */
    public function getControlPanelActiveSection()
    {
        $sections = $this->getControlPanelSections();

        return $sections->active();
    }

    /**
     * Return the active control
     * panel section's HREF.
     *
     * @param null $path
     * @return null|string
     */
    public function getActiveControlPanelSectionHref($path = null)
    {
        $sections = $this->getControlPanelSections();

        if (!$active = $sections->active()) {
            return null;
        }

        return $active->getHref($path);
    }

    /**
     * Return the desired control
     * panel section's HREF.
     *
     * @param $section
     * @param $path
     * @return null|string
     */
    public function getControlPanelSectionHref($section, $path)
    {
        $sections = $this->getControlPanelSections();

        if (!$section = $sections->get($section)) {
            return null;
        }

        return $section->getHref($path);
    }

    /**
     * Get the control panel sections.
     *
     * @return Component\Section\SectionCollection
     */
    public function getControlPanelSections()
    {
        return $this->controlPanel->getSections();
    }

    /**
     * Get the module shortcuts.
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
     * Add shortcuts.
     *
     * @param array $shortcuts
     * @return $this
     */
    public function addShortcuts($shortcuts)
    {
        $this->shortcuts = array_merge($this->shortcuts, $shortcuts);

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
     * Get the control panel navigation.
     *
     * @return Component\Navigation\NavigationCollection
     */
    public function getControlPanelNavigation()
    {
        return $this->controlPanel->getNavigation();
    }
}
