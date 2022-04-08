<?php namespace Anomaly\VariablesModule\Group\Form;

use Anomaly\Streams\Platform\Stream\Form\StreamFormBuilder;

/**
 * Class GroupFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GroupFormBuilder extends StreamFormBuilder
{

    /**
     * The stream prefix.
     *
     * @var string
     */
    protected $prefix = 'variables_';

    /**
     * The stream namespace.
     *
     * @var string
     */
    protected $namespace = 'variables';

    /**
     * The skipped fields.
     *
     * @var array
     */
    protected $skips = [
        'title_column',
        'searchable',
        'trashable',
        'sortable',
        'config',
    ];
}
