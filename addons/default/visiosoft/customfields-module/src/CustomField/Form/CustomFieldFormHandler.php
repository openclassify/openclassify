<?php namespace Visiosoft\CustomfieldsModule\CustomField\Form;

use Visiosoft\CustomfieldsModule\Parent\Contract\ParentRepositoryInterface;

class CustomFieldFormHandler
{
    public function handle(CustomFieldFormBuilder $builder, ParentRepositoryInterface $parentRepository)
    {
        if (!$builder->canSave()) {
            return;
        }

        $config_fields = preg_grep('/^config/i', array_keys(request()->all()));

        foreach ($config_fields as $config) {
            $builder->getForm()->removeField($config);
        }

        $builder->saveForm();
        $entry = $builder->getFormEntry();

        if (request('action') == "save") {
            if ($categories = request('parent_category')) {
                foreach ($categories as $category) {
                    $parentRepository->createNew($entry->getId(), $category);
                }
            }
        } elseif (request('action') == "update") {
            //Remove old
            $parentRepository->deleteByCF($entry->getId());

            if ($categories = request('parent_category')) {
                foreach ($categories as $category) {
                    $parentRepository->createNew($entry->getId(), $category);
                }
            }

            $config_fields = array_flip($config_fields);
            foreach ($config_fields as $field_key => $value) {
                $config_fields[$field_key] = request($field_key);
            }

            $entry->setAttribute('config', json_encode($config_fields));
            $entry->save();
        }
    }
}
