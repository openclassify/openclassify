<?php namespace Anomaly\Streams\Platform\Ui\Grid\Command;

use Anomaly\Streams\Platform\Ui\Grid\GridBuilder;

/**
 * Class SetDefaultParameters
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class SetDefaultParameters
{

    /**
     * The grid builder.
     *
     * @var GridBuilder
     */
    protected $builder;

    /**
     * Create a new SetDefaultParameters instance.
     *
     * @param GridBuilder $builder
     */
    public function __construct(GridBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        /*
         * Set the default buttons handler based
         * on the builder class. Defaulting to
         * no handler.
         */
        if (!$this->builder->getButtons()) {
            $buttons = str_replace('GridBuilder', 'GridButtons', get_class($this->builder));

            if (class_exists($buttons)) {
                $this->builder->setButtons($buttons . '@handle');
            }
        }
    }
}
