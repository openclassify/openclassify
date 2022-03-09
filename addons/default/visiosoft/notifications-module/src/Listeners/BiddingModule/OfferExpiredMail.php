<?php namespace Visiosoft\NotificationsModule\Listeners\BiddingModule;

use Visiosoft\AdvsModule\Support\Command\Currency;
use Visiosoft\BiddingModule\Offer\Events\OfferExpired;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;

class OfferExpiredMail
{
    private $template;
    private $currency;

    public function __construct(TemplateRepositoryInterface $templateRepository,Currency $currency)
    {
        $this->template = $templateRepository;
        $this->currency = $currency;
    }

    public function handle(OfferExpired $event)
    {
        $offer = $event->getOffer();
        $adv = $event->getAd();
        $seller = $event->seller();
        $buyer = $event->buyer();

        $template = $this->template->findBySlug('offer_expired');

        if ($template && $offer && $adv && $seller && $buyer) {

            try {
                $mail_params = [
                    'product_name' => $adv->name,
                    'display_name' => $seller->name(),
                    'product_id' => $adv->id,
                    'my_offers_url' => route('visiosoft.module.bidding::profile.my_offers'),
                ];

                $buyer->notify(new MailTemplate($template->getTemplateForArray($mail_params)));

                return true;

            } catch (\Exception $exception) {
                return false;
            }
        }
    }
}
