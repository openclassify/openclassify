<?php namespace Visiosoft\CustomfieldsModule\CustomField\Form;

class CustomFieldFormActions
{
    public function handle(CustomFieldFormBuilder $builder)
    {
        $actions = ['save'];
        if ($builder->getFormMode() == "edit") {
            $actions = ['update'];
        }

        $builder->setActions($actions);
    }
}
