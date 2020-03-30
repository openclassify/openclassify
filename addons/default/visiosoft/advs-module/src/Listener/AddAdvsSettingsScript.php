<?php namespace Visiosoft\AdvsModule\Listener;

use Anomaly\Streams\Platform\Ui\Table\Event\TableIsQuerying;

class AddAdvsSettingsScript
{

    /**
     * @param TableIsQuerying $event
     */
    public function handle(TableIsQuerying $event)
    {
        if (pathinfo(request()->url())['basename'] === "visiosoft.module.advs") {
            $builder = $event->getBuilder();
            $builder->addAsset('scripts.js', 'visiosoft.module.advs::js/settings.js');
        }
    }
}