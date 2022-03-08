<?php namespace Visiosoft\NotificationsModule\Notify\Notification;

use Anomaly\Streams\Platform\Notification\Message\MailMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;


class SendLoanApplicationMail extends Notification implements ShouldQueue
{
    use Queueable;

    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @param $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * @param $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->view('visiosoft.module.notifications::notification')
            ->subject(trans('visiosoft.module.loancalc::notification.new_loan_application_mail_subject'))
            ->greeting(trans('visiosoft.module.notifications::notification.hi_message'))
            ->line('<strong>' . trans('visiosoft.module.loancalc::notification.loan_application_params') . ':</strong>')
            ->line(trans('visiosoft.module.loancalc::notification.application_ad_id') . ': ' . $this->request['applicationAdId'])
            ->line(trans('visiosoft.module.loancalc::notification.ad_name') . ': ' . $this->request['adName'])
            ->line(trans('visiosoft.module.loancalc::notification.first_payment') . ': ' . $this->request['firstPayment'])
            ->line(trans('visiosoft.module.loancalc::notification.application_term') . ': ' . $this->request['applicationTerm'])
            ->line(trans('visiosoft.module.loancalc::notification.monthly_payment') . ': ' . $this->request['monthlyPayment'])
            ->line(trans('visiosoft.module.loancalc::notification.total_payment') . ': ' . $this->request['totalPayment'])
            ->line(trans('visiosoft.module.loancalc::notification.first_name') . ': ' . $this->request['firstName'])
            ->line(trans('visiosoft.module.loancalc::notification.last_name') . ': ' . $this->request['lastName'])
            ->line(trans('visiosoft.module.loancalc::notification.t.c_number') . ': ' . $this->request['TCNumber'])
            ->line(trans('visiosoft.module.loancalc::notification.day_born') . ': ' . $this->request['born1'])
            ->line(trans('visiosoft.module.loancalc::notification.month_born') . ': ' . $this->request['born2'])
            ->line(trans('visiosoft.module.loancalc::notification.year_born') . ': ' . $this->request['born3'])
            ->line(trans('visiosoft.module.loancalc::notification.user_job_name') . ': ' . $this->request['userJobName'])
            ->line(trans('visiosoft.module.loancalc::notification.user_job') . ': ' . $this->request['userJob'])
            ->line(trans('visiosoft.module.loancalc::notification.gsm_number') . ': ' . $this->request['gsmNumber'])
            ->line(trans('visiosoft.module.loancalc::notification.user_province') . ': ' . $this->request['userProvince'])
            ->line(trans('visiosoft.module.loancalc::notification.email_address') . ': ' . $this->request['emailAdress'])
            ->line(trans('visiosoft.module.loancalc::notification.reference_description') . ': ' . $this->request['referenceDescription'])
            ->action(trans('visiosoft.module.loancalc::notification.show_ad'), url($this->request['adLink']))
        ->salutation(trans('visiosoft.module.notifications::notification.thanks_message'));
    }
}
