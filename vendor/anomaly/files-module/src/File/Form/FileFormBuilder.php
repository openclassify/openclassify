<?php namespace Anomaly\FilesModule\File\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class FileFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FileFormBuilder extends FormBuilder
{

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
        'title',
        'alt_text',
        'name' => [
            'disabled' => true,
        ],
        'caption',
        'description',
        'keywords',
    ];
}
