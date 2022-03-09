<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Action\Guesser;

use Anomaly\Streams\Platform\Support\Value;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class EnabledGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class EnabledGuesser
{

    /**
     * The value utility.
     *
     * @var Value
     */
    protected $value;

    /**
     * Create a new EnabledGuesser instance.
     *
     * @param Value $value
     */
    public function __construct(Value $value)
    {
        $this->value = $value;
    }

    /**
     * Guess the action's enabled parameter.
     *
     * @param FormBuilder $builder
     */
    public function guess(FormBuilder $builder)
    {
        $actions = $builder->getActions();

        $mode = $builder->getFormMode();

        foreach ($actions as &$action) {

            if (!isset($action['enabled'])) {
                continue;
            }

            $action['enabled'] = $this->value->make(
                $action['enabled'],
                $builder->getFormEntry()
            );

            if (is_bool($action['enabled']) || in_array($action['enabled'], ['true', 'false'])) {

                $action['enabled'] = filter_var($action['enabled'], FILTER_VALIDATE_BOOLEAN);

                continue;
            }

            $action['enabled'] = ($mode === $action['enabled']);
        }

        $builder->setActions($actions);
    }
}
