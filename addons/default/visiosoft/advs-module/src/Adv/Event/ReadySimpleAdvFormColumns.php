<?php namespace Visiosoft\AdvsModule\Adv\Event;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Database\Eloquent\Builder;

class ReadySimpleAdvFormColumns
{

    protected $fields;
    public function __construct($fields)
    {
        $this->fields = $fields;
    }

    public function getFields()
    {
        return $this->fields;
    }
}
