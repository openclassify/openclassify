<?php namespace Anomaly\NavigationModule\Link\Form;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\NavigationModule\Link\Type\LinkTypeExtension;
use Anomaly\NavigationModule\Menu\Contract\MenuInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class LinkFormBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class LinkFormBuilder extends FormBuilder
{

    /**
     * The related link type.
     *
     * @var null|LinkTypeExtension
     */
    protected $type = null;

    /**
     * The related menu.
     *
     * @var null|MenuInterface
     */
    protected $menu = null;

    /**
     * The parent link.
     *
     * @var null|LinkInterface
     */
    protected $parent = null;

    /**
     * The skipped fields.
     *
     * @var array
     */
    protected $skips = [
        'parent',
        'entry',
        'type',
        'menu',
    ];

    /**
     * Fired when the builder is ready to build.
     *
     * @throws \Exception
     */
    public function onReady()
    {
        if (!$this->getType() && !$this->getEntry()) {
            throw new \Exception('The $type parameter is required when creating a link.');
        }

        if (!$this->getMenu() && !$this->getEntry()) {
            throw new \Exception('The $menu parameter is required when creating a link.');
        }
    }

    /**
     * Fired just before saving the entry.
     */
    public function onSaving()
    {
        $parent = $this->getParent();
        $entry  = $this->getFormEntry();

        if (!$entry->menu_id && $menu = $this->getMenu()) {
            $entry->menu_id = $menu->getId();
        }

        if ($type = $this->getType()) {
            $entry->type = $type->getNamespace();
        }

        if ($parent) {
            $entry->parent_id = $parent->getId();
        }
    }

    /**
     * Get the type.
     *
     * @return null|LinkTypeExtension
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the type.
     *
     * @param  LinkTypeExtension $type
     * @return $this
     */
    public function setType(LinkTypeExtension $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the menu.
     *
     * @return MenuInterface|null
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set the menu.
     *
     * @param $menu
     * @return $this
     */
    public function setMenu(MenuInterface $menu)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get the parent link.
     *
     * @return null|LinkInterface
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set the parent link.
     *
     * @param  LinkInterface $parent
     * @return $this
     */
    public function setParent(LinkInterface $parent)
    {
        $this->parent = $parent;

        return $this;
    }
}
