<?php namespace Visiosoft\ProfileModule\Adress\FormCompany;

use Illuminate\Support\Facades\Auth;

class AddressCompanyFormHandler
{
    public function handle(AddressCompanyFormBuilder $builder)
    {
        if (!$builder->canSave()) {
            return;
        }

        $builder->saveForm();

        $entry = $builder->getFormEntry();

        $entry->user_id = Auth::id();
        $entry->is_company = true;

        $entry->save();
    }
}
