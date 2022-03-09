<?php namespace Anomaly\Streams\Platform\Ui\Tree\Component\Item;

use Anomaly\Streams\Platform\Ui\Button\ButtonCollection;
use Anomaly\Streams\Platform\Ui\Tree\Component\Item\Contract\ItemInterface;
use Anomaly\Streams\Platform\Ui\Tree\Component\Segment\SegmentCollection;

/**
 * Class Item
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Item implements ItemInterface
{

    /**
     * The item ID.
     *
     * @var int
     */
    protected $id;

    /**
     * The parent ID.
     *
     * @var int
     */
    protected $parent;

    /**
     * The segment collection.
     *
     * @var SegmentCollection
     */
    protected $segments;

    /**
     * The item buttons.
     *
     * @var ButtonCollection
     */
    protected $buttons;

    /**
     * Get the ID.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the ID.
     *
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the parent ID.
     *
     * @return int
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set the parent ID.
     *
     * @param $parent
     * @return $this
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get the segments.
     *
     * @return SegmentCollection
     */
    public function getSegments()
    {
        return $this->segments;
    }

    /**
     * Set the segments.
     *
     * @param  SegmentCollection $segments
     * @return $this
     */
    public function setSegments(SegmentCollection $segments)
    {
        $this->segments = $segments;

        return $this;
    }

    /**
     * Get the buttons.
     *
     * @return ButtonCollection
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     * Set the buttons.
     *
     * @param  ButtonCollection $buttons
     * @return $this
     */
    public function setButtons(ButtonCollection $buttons)
    {
        $this->buttons = $buttons;

        return $this;
    }
}
