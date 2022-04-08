<?php namespace Anomaly\ContactPlugin\Form;

use Anomaly\ContactPlugin\Form\Command\BuildMessage;
use Anomaly\ContactPlugin\Form\Command\GetMessageData;
use Anomaly\ContactPlugin\Form\Command\GetMessageView;
use Anomaly\Streams\Platform\Message\MessageBag;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;

/**
 * Class ContactFormHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class ContactFormHandler
{

    use DispatchesJobs;

    /**
     * Handle the command.
     *
     * @param ContactFormBuilder $builder
     * @param MessageBag         $messages
     * @param Mailer             $mailer
     */
    public function handle(ContactFormBuilder $builder, MessageBag $messages, Mailer $mailer)
    {
        // Validation failed!
        if ($builder->hasFormErrors()) {
            return;
        }

        // Delegate these for now.
        $view = $this->dispatch(new GetMessageView($builder));
        $data = $this->dispatch(new GetMessageData($builder));

        // Build the message object.
        $message = function (Message $message) use ($builder) {
            $this->dispatch(new BuildMessage($message, $builder));
        };

        // Send the email.
        $mailer->send($view, $data, $message);

        // If there are any failures, report.
        if(count($mailer->failures()) > 0) {
            $messages->error(
                $builder->getFormOption('error_message', 'anomaly.plugin.contact::error.send_message')
            );
        } else {
            // Otherwise, show success.
            $messages->success(
                $builder->getFormOption('success_message', 'anomaly.plugin.contact::success.send_message')
            );
        }

        // Clear the form!
        $builder->resetForm();
    }
}
