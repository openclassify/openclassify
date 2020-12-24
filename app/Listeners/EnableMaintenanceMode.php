<?php namespace App\Listeners;

use Anomaly\SettingsModule\Setting\Form\SettingFormRepository;
use Anomaly\Streams\Platform\Ui\Form\Event\FormWasSaved;

class EnableMaintenanceMode
{

    public function handle(FormWasSaved $event)
    {
        $builder = $event->getBuilder();

        if (get_class($builder->getRepository()) === SettingFormRepository::class) {
            if ($builder->getFormValues()->has('maintenance') and $builder->getFormValues()->get('maintenance')) {
                file_put_contents(storage_path('framework/down'),
                    json_encode(['time' => '', 'retry' => null, 'message' => null],
                        JSON_PRETTY_PRINT));
            }
        }
    }
}
