<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel;

use Anomaly\Streams\Platform\Ui\Button\Contract\ButtonInterface;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\Contract\NavigationLinkInterface;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\NavigationCollection;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\Contract\SectionInterface;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\SectionCollection;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Shortcut\Contract\ShortcutInterface;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Shortcut\ShortcutCollection;
use Illuminate\Support\Collection;

/**
 * Class ControlPanel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ControlPanel
{

    /**
     * The section buttons.
     *
     * @var Collection
     */
    protected $buttons;

    /**
     * The section collection.
     *
     * @var SectionCollection
     */
    protected $sections;

    /**
     * The shortcut collection.
     *
     * @var ShortcutCollection
     */
    protected $shortcuts;

    /**
     * The navigation collection.
     *
     * @var NavigationCollection
     */
    protected $navigation;

    /**
     * Create a new ControlPanel instance.
     *
     * @param Collection $buttons
     * @param SectionCollection $sections
     * @param ShortcutCollection $shortcuts
     * @param NavigationCollection $navigation
     */
    public function __construct(
        Collection $buttons,
        SectionCollection $sections,
        ShortcutCollection $shortcuts,
        NavigationCollection $navigation
    ) {
        $this->buttons    = $buttons;
        $this->sections   = $sections;
        $this->shortcuts  = $shortcuts;
        $this->navigation = $navigation;
    }

    /**
     * Add a button to the button collection.
     *
     * @param  ButtonInterface $button
     * @return $this
     */
    public function addButton(ButtonInterface $button)
    {
        $this->buttons->push($button);

        return $this;
    }

    /**
     * Get the section buttons.
     *
     * @return Collection
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     * Add a section to the section collection.
     *
     * @param  SectionInterface $section
     * @return $this
     */
    public function addSection(SectionInterface $section)
    {
        $this->sections->put($section->getSlug(), $section);

        return $this;
    }

    /**
     * Get the module sections.
     *
     * @return SectionCollection
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * Get the active section.
     *
     * @return SectionInterface|null
     */
    public function getActiveSection()
    {
        return $this->sections->active();
    }

    /**
     * Add a shortcut to the shortcut collection.
     *
     * @param  ShortcutInterface $shortcut
     * @return $this
     */
    public function addShortcut(ShortcutInterface $shortcut)
    {
        $this->shortcuts->put($shortcut->getSlug(), $shortcut);

        return $this;
    }

    /**
     * Get the module shortcuts.
     *
     * @return ShortcutCollection
     */
    public function getShortcuts()
    {
        return $this->shortcuts;
    }

    /**
     * Add a navigation link.
     *
     * @param  NavigationLinkInterface $link
     * @return $this
     */
    public function addNavigationLink(NavigationLinkInterface $link)
    {
        $this->navigation->push($link);

        return $this;
    }

    /**
     * Get the navigation.
     *
     * @return NavigationCollection
     */
    public function getNavigation()
    {
        return $this->navigation;
    }
}
