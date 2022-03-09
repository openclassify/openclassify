<?php namespace Anomaly\DashboardModule\Dashboard\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class DashboardFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DashboardFormBuilder extends FormBuilder
{

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [
        'redirect' => 'admin/dashboard/manage',
    ];

}
