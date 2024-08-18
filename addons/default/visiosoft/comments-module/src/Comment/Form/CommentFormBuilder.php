<?php namespace Visiosoft\CommentsModule\Comment\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class CommentFormBuilder extends FormBuilder
{
    protected $skips = [
        'entry'
    ];

    protected $actions = [
        'save'
    ];

    protected $buttons = [
        'cancel',
    ];
}
