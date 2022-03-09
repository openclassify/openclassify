<?php namespace Visiosoft\NotificationsModule\Listeners\BiddingModule;

use Visiosoft\BiddingModule\Offer\Events\OfferApproved;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;

class OfferApprovedMail
{
    private $template;

    public function __construct(TemplateRepositoryInterface $templateRepository)
    {
        $this->template = $templateRepository;
    }

    public function handle(OfferApproved $event)
    {
        $offer = $event->getOffer();
        $adv = $event->getAd();
        $seller = $event->seller();
        $buyer = $event->buyer();

        $template_buyer = $this->template->findBySlug('your_bid_has_been_approved_buyer');
        $template_seller = $this->template->findBySlug('you_have_approved_the_offer_seller');

        if ($offer && $adv && $seller && $buyer) {

            if ($template_buyer && $template_seller) {
                try {
                    $buyer_mail_params = [
                        'product_name' => $adv->name,
                        'display_name' => $buyer->name(),
                        'product_id' => $adv->id,
                        'purchase_url' => route('orders::purchase_detail',['id' => $offer->order_item_id]),
                    ];

                    $seller_mail_params = [
                        'product_name' => $adv->name,
                        'display_name' => $seller->name(),
                        'product_id' => $adv->id,
                        'sales_url' => route('orders::sale_detail',['id' => $offer->order_item_id]),
                    ];

                    $buyer->notify(new MailTemplate($template_buyer->getTemplateForArray($buyer_mail_params)));

                    $seller->notify(new MailTemplate($template_seller->getTemplateForArray($seller_mail_params)));

                    return true;

                } catch (\Exception $exception) {
                    return false;
                }
            }
        }
    }
}
