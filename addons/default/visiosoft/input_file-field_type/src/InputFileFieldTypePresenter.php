<?php namespace Visiosoft\InputFileFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Collective\Html\HtmlBuilder;


class InputFileFieldTypePresenter extends FieldTypePresenter
{

    protected $html;

    public function __construct(HtmlBuilder $html, $object)
    {
        $this->html = $html;

        parent::__construct($object);
    }

}
