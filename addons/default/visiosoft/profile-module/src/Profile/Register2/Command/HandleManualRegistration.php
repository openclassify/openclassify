<?php namespace Visiosoft\ProfileModule\Profile\Register2\Command;

use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Notification\UserPendingActivation;
use Visiosoft\ProfileModule\Profile\Register2\Register2FormBuilder;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Notifications\AnonymousNotifiable;

/**
 * Class HandleManualRegistration
 *
 * @link   http://openclassify.com/
 * @author OpenClassify, Inc. <support@openclassify.com>
 * @author Visiosoft Inc <support@openclassify.com>
 */
class HandleManualRegistration
{

    /**
     * The form builder.
     *
     * @var RegisterFormBuilder
     */
    protected $builder;

    /**
     * Create a new HandleManualRegistration instance.
     *
     * @param RegisterFormBuilder $builder
     */
    public function __construct(Register2FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param MessageBag $messages
     * @param Repository $config
     */
    public function handle(MessageBag $messages, Repository $config)
    {
        if (!is_null($message = $this->builder->getFormOption('pending_message'))) {
            $messages->info($message);
        }

        /* @var UserInterface $user */
        $user = $this->builder->getFormEntry();

        $recipients = $config->get('anomaly.module.users::notifications.pending_user', []);

        foreach ($recipients as $email) {
            (new AnonymousNotifiable)
                ->route('mail', $email)
                ->notify(
                    new UserPendingActivation($user)
                );
        }
    }
}
