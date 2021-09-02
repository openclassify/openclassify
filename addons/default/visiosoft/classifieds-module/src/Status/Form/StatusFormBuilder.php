<?php namespace Visiosoft\ClassifiedsModule\Status\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class StatusFormBuilder extends FormBuilder
{
    protected $skips = [
        'is_system',
    ];

    protected $buttons = [
        'cancel',
    ];
}
