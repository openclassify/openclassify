<?php namespace Visiosoft\ProfileModule\Adress\Form;

use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Event\UserHasRegistered;
use Anomaly\UsersModule\User\Register\Command\HandleAutomaticRegistration;
use Anomaly\UsersModule\User\Register\Command\HandleEmailRegistration;
use Anomaly\UsersModule\User\Register\Command\HandleManualRegistration;
use Anomaly\UsersModule\User\UserActivator;
use Illuminate\Support\Facades\Auth;


class AdressFormHandler
{

    public function handle(
        AdressFormBuilder $builder)
    {
        if (!$builder->canSave()) {
            return;
        }

        $builder->saveForm();

        $entry = $builder->getFormEntry();

        $entry->user_id = Auth::id();

        $entry->save();
    }
}
