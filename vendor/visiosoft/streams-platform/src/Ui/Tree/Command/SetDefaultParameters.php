<?php namespace Anomaly\Streams\Platform\Ui\Tree\Command;

use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;

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
     * The tree builder.
     *
     * @var TreeBuilder
     */
    protected $builder;

    /**
     * Create a new SetDefaultParameters instance.
     *
     * @param TreeBuilder $builder
     */
    public function __construct(TreeBuilder $builder)
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
            $buttons = str_replace('TreeBuilder', 'TreeButtons', get_class($this->builder));

            if (class_exists($buttons)) {
                $this->builder->setButtons($buttons . '@handle');
            }
        }

        /*
         * Set the default segments handler based
         * on the builder class. Defaulting to
         * no handler.
         */
        if (!$this->builder->getSegments()) {
            $segments = str_replace('TreeBuilder', 'TreeSegments', get_class($this->builder));

            if (class_exists($segments)) {
                $this->builder->setSegments($segments . '@handle');
            }
        }
    }
}
