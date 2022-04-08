<?php namespace Anomaly\UsersModule\Role\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class RoleFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class RoleFormBuilder extends FormBuilder
{

    /**
     * The skipped fields.
     *
     * @var array
     */
    protected $skips = [
        'permissions',
    ];
}
