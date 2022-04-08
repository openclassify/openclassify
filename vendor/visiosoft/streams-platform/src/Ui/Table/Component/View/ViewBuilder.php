<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\View;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ViewBuilder
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class ViewBuilder
{

    /**
     * The view reader.
     *
     * @var ViewInput
     */
    protected $input;

    /**
     * The view factory.
     *
     * @var ViewFactory
     */
    protected $factory;

    /**
     * Create a new ViewBuilder instance.
     *
     * @param ViewInput   $input
     * @param ViewFactory $factory
     */
    public function __construct(ViewInput $input, ViewFactory $factory)
    {
        $this->input   = $input;
        $this->factory = $factory;
    }

    /**
     * Build the views.
     *
     * @param TableBuilder $builder
     */
    public function build(TableBuilder $builder)
    {
        $table = $builder->getTable();

        $this->input->read($builder);

        if ($builder->getTableOption('enable_views') === false) {
            return;
        }

        foreach ($builder->getViews() as $view) {
            if (array_get($view, 'enabled', true)) {
                $table->addView($this->factory->make($view));
            }
        }
    }
}
