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

        $builder->saveForm();

        $ad = $builder->getFormEntry();
        if ($ad->status !== 'approved') {
            $ad->approve();
        }

        $advRepository->cover_image_update($ad);
    }
}
