<?php namespace Anomaly\VariablesModule\Variable\Contract;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface VariableRepositoryInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface VariableRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Get a variable.
     *
     * @param $group
     * @param $field
     * @return mixed
     */
    public function get($group, $field);

    /**
     * Get a variable presenter.
     *
     * @param $group
     * @param $field
     * @return FieldTypePresenter|null
     */
    public function presenter($group, $field);

    /**
     * Get a variable group.
     *
     * @param $group
     * @param $field
     * @return EntryInterface|null
     */
    public function group($group);
}
