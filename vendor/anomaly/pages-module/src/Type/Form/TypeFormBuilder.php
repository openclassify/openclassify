<?php namespace Anomaly\PagesModule\Type\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class TypeFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class TypeFormBuilder extends FormBuilder
{

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
        '*',
        'slug' => [
            'disabled' => 'edit',
        ],
    ];
}
