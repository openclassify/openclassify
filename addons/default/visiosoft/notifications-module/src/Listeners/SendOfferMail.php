<?php namespace Visiosoft\NotificationsModule\Listeners;

use Visiosoft\NotificationsModule\Notify\Notification\SendDemandMailAdmin;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\OffersModule\Offer\Events\SendOffer;

class SendOfferMail
{

    private $templateRepository;

    public function __construct(TemplateRepositoryInterface $templateRepository)
    {
        $this->templateRepository = $templateRepository;
    }

    public function handle(SendOffer $event)
    {
        $offer = $event->offer();
        $password = $event->password();

        $template = $this->templateRepository->findBySlug('send_offer');
        $content = $template->message;
        $content = str_replace('{offer_link}', route('message_details', [$offer->chat->id]), $content);
        $content = str_replace('{name}', $offer->offered_to->name(), $content);
        $content = str_replace('{email}', $offer->offered_to->email, $content);
        $content = str_replace('{password}', $password, $content);
        $subject = $template->subject;
        $url = url('/');

        if (!is_null($template)) {
            $offer->offered_to->notify(new SendDemandMailAdmin($content, $subject, $url));
        }
    }
}
