<?php namespace Visiosoft\ProfileModule\Adress\Form;

use Illuminate\Support\Facades\Auth;

class AdressFormHandler
{
    public function handle(AdressFormBuilder $builder)
    {
        if (!$builder->canSave()) {
            return;
        }

        $builder->saveForm();

        $entry = $builder->getFormEntry();

        $entry->user_id = Auth::id();

        $entry->save();
    }
}
