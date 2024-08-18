<?php namespace Visiosoft\CustomfieldsModule\Cfvalue\Form;

use Visiosoft\CustomfieldsModule\Cfvalue\CfvalueModel;
use Visiosoft\CustomfieldsModule\CustomField\Contract\CustomFieldRepositoryInterface;

class CfvalueFormHandler
{
    public function handle(
        CfvalueFormBuilder $builder,
        CustomFieldRepositoryInterface $customFieldRepository
    )
    {
        if ($builder->getForm()->getMode() !== 'create') {
            $builder->saveForm();
            return;
        }

        $customFieldType = $customFieldRepository->find(request()->type);

        if ($customFieldType->type === 'selectimage') {
            $builder->saveForm();
        } else {
            $values = $builder->getFormValues()->toArray();

            $newCFCount = count(max($values));
            $newArray = array();
            for ($i = 0; $i < $newCFCount; $i++) {
                foreach ($values as $index => $langValue) {
                    $newArray[$i][$index] =
                        isset($langValue[$i]) ? $langValue[$i] : '';
                }
            }

            foreach ($newArray as $items) {
                $builder->setFormEntry(new CfvalueModel());

                foreach ($items as $key => $item) {
                    $item = ($item == "zero") ? "0" : $item;
                    $builder->setFormValue($key, $item);
                }

                $builder->saveForm();
                $entry = $builder->getFormEntry();
                $type = request()->type;
                $icon = request()->cf_value_icon;
                if ($type) {
                    $entry->custom_field_id = $type;
                }
                if ($icon){
                    $entry->cf_value_icon = $icon;
                }
                $entry->save();
            }
        }
    }

}
