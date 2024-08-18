<?php namespace Visiosoft\AdvsModule\Adv\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Contracts\Events\Dispatcher;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\AdvsModule\Adv\Event\PriceChange;
use Visiosoft\LocationModule\Country\Contract\CountryRepositoryInterface;
use Visiosoft\LocationModule\Country\CountryModel;

class SimpleAdvFormHandler
{
    public function handle(
        FormBuilder $builder,
        AdvRepositoryInterface $advRepository,
        Dispatcher $event
    )
    {
        if (!$builder->canSave()) {
            return;
        }

        $builder->saveForm();

        if (!$builder->getFormValue('country_id')) {
            $entry = $builder->getFormEntry();
            $entry->setAttribute('country_id', setting_value('visiosoft.module.location::default_country'));
            $entry->save();
        }

        $ad = $advRepository->find($builder->getFormEntryId());
        $status = $builder->getFormValue('status');
        if (empty($status) || $status === 'approved') {
            $ad->approve();
        }
        $event->dispatch(new PriceChange($ad));

        $advRepository->cover_image_update($ad);
    }
}
