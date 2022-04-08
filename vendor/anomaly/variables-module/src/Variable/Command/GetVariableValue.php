<?php namespace Anomaly\VariablesModule\Variable\Command;

use Anomaly\VariablesModule\Variable\Contract\VariableRepositoryInterface;


/**
 * Class GetVariableValue
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetVariableValue
{

    /**
     * The variable group.
     *
     * @var string
     */
    protected $group;

    /**
     * The variable field.
     *
     * @var string
     */
    protected $field;

    /**
     * The default value.
     *
     * @var mixed
     */
    protected $default;

    /**
     * Create a new GetVariableValue instance.
     *
     * @param      $group
     * @param      $field
     * @param null $default
     */
    public function __construct($group, $field, $default = null)
    {
        $this->group   = $group;
        $this->field   = $field;
        $this->default = $default;
    }

    /**
     * Handle the command.
     *
     * @param  VariableRepositoryInterface $variables
     * @return mixed
     */
    public function handle(VariableRepositoryInterface $variables)
    {
        if (!$group = $variables->group($this->group)) {
            return $this->default;
        }

        return $group->getAttribute($this->field) ?: $this->default;
    }
}
