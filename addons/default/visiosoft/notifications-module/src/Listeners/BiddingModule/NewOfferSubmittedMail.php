<?php namespace Visiosoft\NotificationsModule\Listeners\BiddingModule;

use Visiosoft\AdvsModule\Support\Command\Currency;
use Visiosoft\BiddingModule\Offer\Events\NewOfferSubmitted;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;

class NewOfferSubmittedMail
{
    private $template;
    private $currency;

    public function __construct(TemplateRepositoryInterface $templateRepository,Currency $currency)
    {
        $this->template = $templateRepository;
        $this->currency = $currency;
    }

    public function handle(NewOfferSubmitted $event)
    {
        $offer = $event->getOffer();
        $adv = $event->getAd();
        $seller = $event->seller();
        $buyer = $event->buyer();

        $template = $this->template->findBySlug('new_offer_submitted');

        if ($template && $offer && $adv && $seller && $buyer) {

            try {
                $mail_params = [
                    'product_name' => $adv->name,
                    'display_name' => $seller->name(),
                    'bidder_name' => $buyer->name(),
                    'new_bid_price' => $this->currency->format($offer->bid_price,$adv->currency),
                    'product_id' => $adv->id,
                ];

                $seller->notify(new MailTemplate($template->getTemplateForArray($mail_params)));

                return true;

            } catch (\Exception $exception) {
                return false;
            }
        }
    }
}
