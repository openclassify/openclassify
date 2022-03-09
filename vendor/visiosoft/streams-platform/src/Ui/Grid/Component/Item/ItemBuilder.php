<?php namespace Anomaly\Streams\Platform\Ui\Grid\Component\Item;

use Anomaly\Streams\Platform\Support\Evaluator;
use Anomaly\Streams\Platform\Ui\Grid\Component\Button\ButtonBuilder;
use Anomaly\Streams\Platform\Ui\Grid\Component\Item;
use Anomaly\Streams\Platform\Ui\Grid\GridBuilder;

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
     * The value utility.
     *
     * @var ItemValue
     */
    protected $value;

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
     * @param ItemValue     $value
     * @param ButtonBuilder $buttons
     * @param ItemFactory   $factory
     * @param Evaluator     $evaluator
     */
    public function __construct(ItemValue $value, ButtonBuilder $buttons, ItemFactory $factory, Evaluator $evaluator)
    {
        $this->value     = $value;
        $this->buttons   = $buttons;
        $this->factory   = $factory;
        $this->evaluator = $evaluator;
    }

    /**
     * Build the items.
     *
     * @param GridBuilder $builder
     */
    public function build(GridBuilder $builder)
    {
        foreach ($builder->getGridEntries() as $entry) {
            $buttons = $this->buttons->build($builder, $entry);

            $buttons = $buttons->enabled();

            $value = $this->value->make($builder, $entry);

            $id = $entry->getId();

            $item = compact('builder', 'buttons', 'entry', 'value', 'id');

            $item = $this->evaluator->evaluate($item, compact('builder', 'entry'));

            $builder->addGridItem($this->factory->make($item));
        }
    }
}
