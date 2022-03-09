<?php namespace Anomaly\PagesModule\Entry\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class EntryFormBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class EntryFormBuilder extends FormBuilder
{

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [
        'locking_enabled' => false,
    ];
}
