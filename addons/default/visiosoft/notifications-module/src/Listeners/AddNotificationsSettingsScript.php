<?php namespace Visiosoft\NotificationsModule\Listeners;

use Anomaly\Streams\Platform\Ui\Form\Event\FormWasBuilt;

class AddNotificationsSettingsScript
{

    /**
     * @param FormWasBuilt $event
     */
    public function handle(FormWasBuilt $event)
    {
        if (pathinfo(request()->url())['basename'] === "visiosoft.module.notifications") {
            config()->set('anomaly.field_type.wysiwyg::redactor.plugins.imagemanager.scripts', [
                'visiosoft.module.notifications::js/imagemanager.js'
            ]);
        }
    }
}
