<?php namespace Visiosoft\ClassifiedsModule\Classified\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Visiosoft\ClassifiedsModule\Classified\Contract\ClassifiedRepositoryInterface;

class SimpleClassifiedFormHandler
{
    public function handle(FormBuilder $builder, ClassifiedRepositoryInterface $classifiedRepository)
    {
        if (!$builder->canSave()) {
            return;
        }

        if (!$builder->getFormValue('created_by_id')) {
            $builder->setFormValue('created_by_id', auth()->id());
        }

        $builder->saveForm();

        $classified = $classifiedRepository->find($builder->getFormEntryId());
        if (!$builder->getFormValue('status') && $classified->status !== 'approved') {
            $classified->approve();
        }

        $classifiedRepository->cover_image_update($classified);
    }
}
