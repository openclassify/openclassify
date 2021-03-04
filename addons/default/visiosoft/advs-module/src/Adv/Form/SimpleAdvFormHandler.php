<?php namespace Visiosoft\AdvsModule\Adv\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;

class SimpleAdvFormHandler
{
    public function handle(FormBuilder $builder, AdvRepositoryInterface $advRepository)
    {
        if (!$builder->canSave()) {
            return;
        }

        if (!$builder->getFormValue('created_by_id')) {
            $builder->setFormValue('created_by_id', auth()->id());
        }

        $builder->saveForm();

        $ad = $advRepository->find($builder->getFormEntryId());
        if (!$builder->getFormValue('status') && $ad->status !== 'approved') {
            $ad->approve();
        }

        $advRepository->cover_image_update($ad);
    }
}
