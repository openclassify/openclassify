<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Action\Guesser;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class HandlerGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class HandlerGuesser
{

    /**
     * Guess the action handler.
     *
     * @param TableBuilder $builder
     */
    public function guess(TableBuilder $builder)
    {
        $actions = $builder->getActions();

        foreach ($actions as &$action) {

            // Only if it's not already set.
            if (!isset($action['handler'])) {
                if (class_exists($class = $this->guessClass($builder, $action))) {
                    $action['handler'] = $class . '@handle';
                }
            }
        }

        $builder->setActions($actions);
    }

    /**
     * Guess the handler class from the builder.
     *
     * @param  TableBuilder $builder
     * @param  array        $action
     * @return string
     */
    protected function guessClass(TableBuilder $builder, array $action)
    {
        $class = explode('\\', get_class($builder));

        array_pop($class);

        return implode('\\', $class) . '\\Action\\' . ucfirst(camel_case($action['slug'])) . 'Handler';
    }
}
