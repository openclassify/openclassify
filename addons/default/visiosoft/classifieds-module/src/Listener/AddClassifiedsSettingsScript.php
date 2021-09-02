<?php namespace Visiosoft\ClassifiedsModule\Listener;

use Anomaly\Streams\Platform\Ui\Table\Event\TableIsQuerying;

class AddClassifiedsSettingsScript
{

    /**
     * @param TableIsQuerying $event
     */
    public function handle(TableIsQuerying $event)
    {
        if (pathinfo(request()->url())['basename'] === "visiosoft.module.classifieds") {
            $builder = $event->getBuilder();
            $builder->addAsset('scripts.js', 'visiosoft.module.classifieds::js/settings.js');
        }
    }
}