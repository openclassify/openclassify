<?php namespace App\Listeners;

use Anomaly\SettingsModule\Setting\Form\SettingFormRepository;
use Anomaly\Streams\Platform\Ui\Form\Event\FormWasSaved;
use Illuminate\Support\Facades\Artisan;

class EnableMaintenanceMode
{

    public function handle(FormWasSaved $event)
    {
        $builder = $event->getBuilder();
        if (get_class($builder->getRepository()) === SettingFormRepository::class) {
            if ($builder->getFormValues()->has('maintenance')) {
                if ($builder->getFormValues()->get('maintenance')) {
                    Artisan::call('down');
                } elseif (config('streams::maintenance.enabled')) {
                    Artisan::call('up');
                }
            }
        }
    }
}
