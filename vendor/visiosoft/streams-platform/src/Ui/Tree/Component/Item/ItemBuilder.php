<?php namespace Anomaly\Streams\Platform\Ui\Tree\Component\Item;

use Anomaly\Streams\Platform\Support\Evaluator;
use Anomaly\Streams\Platform\Ui\Tree\Component\Button\ButtonBuilder;
use Anomaly\Streams\Platform\Ui\Tree\Component\Item;
use Anomaly\Streams\Platform\Ui\Tree\Component\Segment\SegmentBuilder;
use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;

/**
 * Class ItemBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ItemBuilder
{

    /**
     * The segment builder.
     *
     * @var SegmentBuilder
     */
    protected $segments;

    /**
     * The button builder.
     *
     * @var ButtonBuilder
     */
    protected $buttons;

    /**
     * @var ItemFactory
     */
    protected $factory;

    /**
     * The evaluator utility.
     *
     * @var Evaluator
     */
    protected $evaluator;

    /**
     * Create a new ItemBuilder instance.
     *
     * @param SegmentBuilder $segments
     * @param ButtonBuilder  $buttons
     * @param ItemFactory    $factory
     * @param Evaluator      $evaluator
     */
    public function __construct(
        SegmentBuilder $segments,
        ButtonBuilder $buttons,
        ItemFactory $factory,
        Evaluator $evaluator
    ) {
        $this->segments  = $segments;
        $this->buttons   = $buttons;
        $this->factory   = $factory;
        $this->evaluator = $evaluator;
    }

    /**
     * Build the items.
     *
     * @param TreeBuilder $builder
     */
    public function build(TreeBuilder $builder)
    {
        foreach ($builder->getTreeEntries() as $entry) {
            $segments = $this->segments->build($builder, $entry);
            $buttons  = $this->buttons->build($builder, $entry);

            $buttons = $buttons->enabled();

            $id     = $entry->getId();
            $parent = $entry->{$builder->getTreeOption('parent_segment', 'parent_id')};

            $item = compact('builder', 'segments', 'buttons', 'entry', 'parent', 'id');

            $item = $this->evaluator->evaluate($item, compact('builder', 'entry'));

            $builder->addTreeItem($this->factory->make($item));
        }
    }
}
