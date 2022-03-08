<?php namespace Visiosoft\NotificationsModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Ui\Form\Event\FormWasBuilt;
use Anomaly\UsersModule\User\Event\UserHasRegistered;
use Visiosoft\AdvsModule\Adv\Event\ChangedStatusAd;
use Visiosoft\AdvsModule\Adv\Event\CreatedAd;
use Visiosoft\BiddingModule\Offer\Events\NewOfferSubmitted;
use Visiosoft\BiddingModule\Offer\Events\OfferApproved;
use Visiosoft\BiddingModule\Offer\Events\OfferExpired;
use Visiosoft\BookingModule\Booking\Events\CancellationBooking;
use Visiosoft\BookingModule\Booking\Events\remindingTomorrow;
use Visiosoft\CartsModule\Cart\Event\CartAbandoned;
use Visiosoft\DemandModule\Demand\Events\CreateDemand;
use Visiosoft\FranchModule\Events\FranchisorBrandInfoSent;
use Visiosoft\FranchModule\Events\SolutionPartnerInfoSent;
use Visiosoft\HprojectsModule\Events\SendFindHouse;
use Visiosoft\MessagesModule\Events\MessageCreated;
use Visiosoft\NotificationsModule\Listeners\AddedDomainSiteAdminMail;
use Visiosoft\NotificationsModule\Listeners\AddedDomainSiteMail;
use Visiosoft\NotificationsModule\Listeners\AddedTrackingNumberNotification;
use Visiosoft\NotificationsModule\Listeners\AddNotificationsSettingsScript;
use Visiosoft\NotificationsModule\Listeners\BiddingModule\NewOfferSubmittedMail;
use Visiosoft\NotificationsModule\Listeners\BiddingModule\OfferApprovedMail;
use Visiosoft\NotificationsModule\Listeners\BiddingModule\OfferExpiredMail;
use Visiosoft\NotificationsModule\Listeners\CanceledSubscriptionForWebhookAdminMail;
use Visiosoft\NotificationsModule\Listeners\CanceledSubscriptionForWebhookMail;
use Visiosoft\NotificationsModule\Listeners\ChangeStatusAdMail;
use Visiosoft\NotificationsModule\Listeners\CompletedInstallationSiteAdminMail;
use Visiosoft\NotificationsModule\Listeners\CompletedInstallationSiteMail;
use Visiosoft\NotificationsModule\Listeners\CreatedAdMail;
use Visiosoft\NotificationsModule\Listeners\CreateDemandMail;
use Visiosoft\NotificationsModule\Listeners\CreatedRefundRequestNotification;
use Visiosoft\NotificationsModule\Listeners\CreatedSubscriptionAdminMail;
use Visiosoft\NotificationsModule\Listeners\CreatedSubscriptionForWebhookAdminMail;
use Visiosoft\NotificationsModule\Listeners\CreatedSubscriptionForWebhookMail;
use Visiosoft\NotificationsModule\Listeners\CreatedSubscriptionMail;
use Visiosoft\NotificationsModule\Listeners\CreatedSubscriptionOnManuel;
use Visiosoft\NotificationsModule\Listeners\CreateSiteForUserMail;
use Visiosoft\NotificationsModule\Listeners\DeletedDomainSiteMail;
use Visiosoft\NotificationsModule\Listeners\DeletedSubscriptionMail;
use Visiosoft\NotificationsModule\Listeners\ErrorBuildingSiteForWebhookMail;
use Visiosoft\NotificationsModule\Listeners\ErrorCreateSiteByAdminMail;
use Visiosoft\NotificationsModule\Listeners\ErrorSuspendSiteForSubscriptionByAdminMail;
use Visiosoft\NotificationsModule\Listeners\ErrorSuspendSiteForWebhookMail;
use Visiosoft\NotificationsModule\Listeners\ErrorUnSuspendSiteForSubscriptionByAdminMail;
use Visiosoft\NotificationsModule\Listeners\ErrorUnSuspendSiteForWebhookMail;
use Visiosoft\NotificationsModule\Listeners\GuideForYesterdayOpenedSitesMail;
use Visiosoft\NotificationsModule\Listeners\InstalledAddonMail;
use Visiosoft\NotificationsModule\Listeners\IyzicoErrorsForAdminMail;
use Visiosoft\NotificationsModule\Listeners\OrderCreatedMail;
use Visiosoft\NotificationsModule\Listeners\RegisteredUser;
use Visiosoft\NotificationsModule\Listeners\remindingTomorrowMail;
use Visiosoft\NotificationsModule\Listeners\RenewedSubscriptionForWebhookMail;
use Visiosoft\NotificationsModule\Listeners\SendOfferMail;
use Visiosoft\NotificationsModule\Listeners\SiteSendTemplateMail;
use Visiosoft\NotificationsModule\Listeners\SubscriptionExpiredMail;
use Visiosoft\NotificationsModule\Listeners\SubscriptionPaymentFailedForWebhookMail;
use Visiosoft\NotificationsModule\Listeners\SubscriptionPaymentRefundedForWebhookMail;
use Visiosoft\NotificationsModule\Listeners\SubscriptionRemainingMail;
use Visiosoft\NotificationsModule\Listeners\SuspendedSiteByAdminMail;
use Visiosoft\NotificationsModule\Listeners\SuspendedSiteForSubscriptionByAdminMail;
use Visiosoft\NotificationsModule\Listeners\SuspendedSiteForWebhookMail;
use Visiosoft\NotificationsModule\Listeners\SuspendedSubscriptionMail;
use Visiosoft\NotificationsModule\Listeners\UnSuspendedSiteByAdminMail;
use Visiosoft\NotificationsModule\Listeners\UnSuspendedSiteForSubscriptionByAdminMail;
use Visiosoft\NotificationsModule\Listeners\UnSuspendedSubscriptionMail;
use Visiosoft\NotificationsModule\Notify\Listener\PasswordChangedNotification;
use Visiosoft\NotificationsModule\Listeners\UpdatedRefundRequestNotification;
use Visiosoft\NotificationsModule\Notify\Listener\SendAbandonedCartNotification;
use Visiosoft\NotificationsModule\Notify\Listener\SendFranchisorBrandNotification;
use Visiosoft\NotificationsModule\Notify\Listener\SendMessageNotification;
use Visiosoft\NotificationsModule\Notify\Listener\SendReferenceNotification;
use Visiosoft\NotificationsModule\Notify\Listener\SendSolutionPartnerNotification;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\TemplateRepository;
use Anomaly\Streams\Platform\Model\Notifications\NotificationsTemplateEntryModel;
use Visiosoft\NotificationsModule\Template\TemplateModel;
use Visiosoft\BookingModule\Booking\Events\ActivationBooking;
use Visiosoft\BookingModule\Booking\Events\CreateBooking;
use Visiosoft\BookingModule\Booking\Events\SendUserPassword;
use Visiosoft\NotificationsModule\Notify\Listener\AgainPurchase;
use Visiosoft\NotificationsModule\Notify\Listener\AgainSale;
use Visiosoft\NotificationsModule\Smsnotify\Contract\SmsnotifyRepositoryInterface;
use Visiosoft\NotificationsModule\Smsnotify\SmsnotifyRepository;
use Visiosoft\NotificationsModule\Smsnotify\SmsnotifyModel;
use Visiosoft\AdvsModule\Adv\Event\ChangeStatusAd;
use Visiosoft\AdvsModule\Adv\Event\CreateAd;
use Visiosoft\CartsModule\Cart\Event\Payment;
use Visiosoft\NotificationsModule\Notify\Contract\NotifyRepositoryInterface;
use Visiosoft\NotificationsModule\Notify\Listener\NewAd;
use Visiosoft\NotificationsModule\Notify\Listener\PaySuccess;
use Visiosoft\NotificationsModule\Notify\Listener\StatusAd;
use Visiosoft\NotificationsModule\Notify\NotifyRepository;
use Anomaly\Streams\Platform\Model\Notifications\NotificationsNotifyEntryModel;
use Visiosoft\NotificationsModule\Notify\NotifyModel;
use Visiosoft\OffersModule\Offer\Events\SendOffer;
use Visiosoft\OrdersModule\Events\OrderCreated;
use Visiosoft\OrdersModule\Order\Events\AddedTrackingNumber;
use Visiosoft\OrdersModule\RefundRequest\Events\CreatedRefundRequest;
use Visiosoft\OrdersModule\RefundRequest\Events\UpdatedRefundRequest;
use Visiosoft\PaymentIyzicoModule\Events\IyzicoErrors;
use Visiosoft\ProfileModule\Events\PasswordChanged;
use Visiosoft\ProfileModule\Events\UserActivatedByMail;
use Visiosoft\ReferencesModule\Events\ReferencedUserWasCreated;
use Visiosoft\SiteModule\Domain\Event\CreatedDomain;
use Visiosoft\SiteModule\Domain\Event\DeletedDomain;
use Visiosoft\SiteModule\Site\Event\CompletedInstallationSite;
use Visiosoft\SiteModule\Site\Event\ErrorCreateSite;
use Visiosoft\SiteModule\Site\Event\GuideForYesterdayOpenedSites;
use Visiosoft\SiteModule\Site\Event\InstalledAddon;
use Visiosoft\SiteModule\Site\Event\SendEmailTemplate;
use Visiosoft\SiteModule\Site\Event\subscriptions\ErrorSuspendSiteForSubscription;
use Visiosoft\SiteModule\Site\Event\subscriptions\ErrorUnSuspendSiteForSubscription;
use Visiosoft\SiteModule\Site\Event\subscriptions\SuspendedSiteForSubscription;
use Visiosoft\SiteModule\Site\Event\subscriptions\UnSuspendedSiteForSubscription;
use Visiosoft\SiteModule\Site\Event\SuspendedSite;
use Visiosoft\SiteModule\Site\Event\UnSuspendedSite;
use Visiosoft\SiteModule\Site\Event\webhook\ErrorBuildingSiteForWebhook;
use Visiosoft\SiteModule\Site\Event\webhook\ErrorSuspendSiteForWebhook;
use Visiosoft\SiteModule\Site\Event\webhook\ErrorUnsuspendSiteForWebhook;
use Visiosoft\SiteModule\Site\Event\webhook\SuspendedSiteForWebhook;
use Visiosoft\SubscriptionsModule\Subscription\Event\CreatedSubscription;
use Visiosoft\SubscriptionsModule\Subscription\Event\CreateSubscriptionOnManuel;
use Visiosoft\SubscriptionsModule\Subscription\Event\DeletedSubscription;
use Visiosoft\SubscriptionsModule\Subscription\Event\ExpiredSubscription;
use Visiosoft\OrdersModule\Orderdetail\Event\AgainPurchaseOrder;
use Visiosoft\OrdersModule\Orderdetail\Event\AgainSaleOrder;
use Visiosoft\OrdersModule\Orderdetail\Event\PaymentOrder;
use Visiosoft\OrdersModule\Orderdetail\Event\RefundOrder;
use Visiosoft\OrdersModule\Orderdetail\Event\ReportOrder;
use Visiosoft\SubscriptionsModule\Subscription\Event\RemainingSubscription;
use Visiosoft\SubscriptionsModule\Subscription\Event\SuspendedSubscription;
use Visiosoft\SubscriptionsModule\Subscription\Event\UnSuspendedSubscription;
use Visiosoft\SubscriptionsModule\Subscription\Event\webhook\SubscriptionCreatedForWebhook;
use Visiosoft\SubscriptionsModule\Subscription\Event\webhook\SubscriptionDeletedForWebhook;
use Visiosoft\SubscriptionsModule\Subscription\Event\webhook\SubscriptionFailedForWebhook;
use Visiosoft\SubscriptionsModule\Subscription\Event\webhook\SubscriptionRenewedForWebhook;
use Visiosoft\SubscriptionsModule\Subscription\Event\webhook\SubscriptionSuspendForWebhook;

class NotificationsModuleServiceProvider extends AddonServiceProvider
{
    protected $routes = [
        'admin/notifications' => 'Visiosoft\NotificationsModule\Http\Controller\Admin\TemplateController@index',
        'admin/notifications/create' => 'Visiosoft\NotificationsModule\Http\Controller\Admin\TemplateController@create',
        'admin/notifications/edit/{id}' => 'Visiosoft\NotificationsModule\Http\Controller\Admin\TemplateController@edit',
    ];

    protected $listeners = [
        FormWasBuilt::class => [
            AddNotificationsSettingsScript::class,
        ],

        ChangedStatusAd::class => [
            ChangeStatusAdMail::class
        ],

        CreatedAd::class => [
            CreatedAdMail::class
        ],
        UserHasRegistered::class => [
            RegisteredUser::class
        ],

        SendEmailTemplate::class => [
            SiteSendTemplateMail::class
        ],

        // Offers Module
        SendOffer::class => [
            SendOfferMail::class
        ],
        CreateDemand::class => [
            CreateDemandMail::class
        ],

        //Booking Module
        remindingTomorrow::class => [
            remindingTomorrowMail::class,
        ],

        CreateAd::class =>
            [
                NewAd::class,
            ],
        ChangeStatusAd::class =>
            [
                StatusAd::class,
            ],
        Payment::class =>
            [
                PaySuccess::class,
            ],
        AgainPurchaseOrder::class =>
            [
                AgainPurchase::class,
            ],
        AgainSaleOrder::class =>
            [
                AgainSale::class,
            ],
        PaymentOrder::class =>
            [
                \Visiosoft\NotificationsModule\Notify\Listener\PaymentOrder::class,
            ],
        RefundOrder::class =>
            [
                \Visiosoft\NotificationsModule\Notify\Listener\RefundOrder::class,
            ],
        ReportOrder::class =>
            [
                \Visiosoft\NotificationsModule\Notify\Listener\ReportOrder::class,
            ],

        //Booking Model
        SendUserPassword::class =>
            [
                \Visiosoft\NotificationsModule\Notify\Listener\SendUserPassword::class,
            ],
        CreateBooking::class =>
            [
                \Visiosoft\NotificationsModule\Notify\Listener\CreateBooking::class,
            ],
        ActivationBooking::class =>
            [
                \Visiosoft\NotificationsModule\Notify\Listener\ActivationBooking::class,
            ],
        CancellationBooking::class =>
            [
                \Visiosoft\NotificationsModule\Notify\Listener\CancellationBooking::class,
            ],

        //Site && Subscriptions
        UserActivatedByMail::class => [
            CreateSiteForUserMail::class,
        ],

        CompletedInstallationSite::class => [
            CompletedInstallationSiteMail::class,
            CompletedInstallationSiteAdminMail::class,
        ],
        CreatedSubscription::class => [
            CreatedSubscriptionMail::class,
            CreatedSubscriptionAdminMail::class,
        ],
        InstalledAddon::class => [
            InstalledAddonMail::class,
        ],
        GuideForYesterdayOpenedSites::class => [
            GuideForYesterdayOpenedSitesMail::class,
        ],
        RemainingSubscription::class => [
            SubscriptionRemainingMail::class,
        ],
        ExpiredSubscription::class => [
            SubscriptionExpiredMail::class,
        ],
        DeletedSubscription::class => [
            DeletedSubscriptionMail::class
        ],
        UnSuspendedSubscription::class => [
            UnSuspendedSubscriptionMail::class
        ],
        SuspendedSubscription::class => [
            SuspendedSubscriptionMail::class
        ],
        SubscriptionDeletedForWebhook::class => [
            CanceledSubscriptionForWebhookMail::class,
            CanceledSubscriptionForWebhookAdminMail::class
        ],
        SubscriptionFailedForWebhook::class => [
            SubscriptionPaymentFailedForWebhookMail::class
        ],
        SubscriptionRenewedForWebhook::class => [
            RenewedSubscriptionForWebhookMail::class,
        ],
        SubscriptionCreatedForWebhook::class => [
            CreatedSubscriptionForWebhookMail::class,
            CreatedSubscriptionForWebhookAdminMail::class,
        ],
        SubscriptionSuspendForWebhook::class => [
            SubscriptionPaymentRefundedForWebhookMail::class
        ],
        SuspendedSite::class => [
            SuspendedSiteByAdminMail::class
        ],
        UnSuspendedSite::class => [
            UnSuspendedSiteByAdminMail::class
        ],
        UnSuspendedSiteForSubscription::class => [
            UnSuspendedSiteForSubscriptionByAdminMail::class
        ],
        ErrorUnSuspendSiteForSubscription::class => [
            ErrorUnSuspendSiteForSubscriptionByAdminMail::class
        ],
        SuspendedSiteForSubscription::class => [
            SuspendedSiteForSubscriptionByAdminMail::class,
        ],
        ErrorSuspendSiteForSubscription::class => [
            ErrorSuspendSiteForSubscriptionByAdminMail::class
        ],
        SuspendedSiteForWebhook::class => [
            SuspendedSiteForWebhookMail::class,
        ],
        ErrorSuspendSiteForWebhook::class => [
            ErrorSuspendSiteForWebhookMail::class,
        ],
        ErrorUnsuspendSiteForWebhook::class => [
            ErrorUnSuspendSiteForWebhookMail::class,
        ],
        ErrorBuildingSiteForWebhook::class => [
            ErrorBuildingSiteForWebhookMail::class,
        ],
        ErrorCreateSite::class => [
            ErrorCreateSiteByAdminMail::class,
        ],
        CreatedDomain::class => [
            AddedDomainSiteMail::class,
            AddedDomainSiteAdminMail::class
        ],
        DeletedDomain::class => [
            DeletedDomainSiteMail::class
        ],
        CreateSubscriptionOnManuel::class => [
            CreatedSubscriptionOnManuel::class,
        ],

        SendFindHouse::class => [
            \Visiosoft\NotificationsModule\Notify\Listener\SendFindHouse::class
        ],

        //Order Model
        OrderCreated::class => [
            OrderCreatedMail::class
        ],
        AddedTrackingNumber::class => [
            AddedTrackingNumberNotification::class
        ],


        MessageCreated::class => [
            SendMessageNotification::class
        ],

        PasswordChanged::class => [
            PasswordChangedNotification::class
        ],

        CartAbandoned::class => [
            SendAbandonedCartNotification::class
        ],

        FranchisorBrandInfoSent::class => [
            SendFranchisorBrandNotification::class
        ],
        SolutionPartnerInfoSent::class => [
            SendSolutionPartnerNotification::class
        ],

        ReferencedUserWasCreated::class => [
            SendReferenceNotification::class
        ],

        //Payment Iyzico
        IyzicoErrors::class => [
            IyzicoErrorsForAdminMail::class
        ],

        //Refund Request
        CreatedRefundRequest::class => [
            CreatedRefundRequestNotification::class
        ],
        UpdatedRefundRequest::class => [
            UpdatedRefundRequestNotification::class
        ],

        // Bidding Module
        NewOfferSubmitted::class => [
            NewOfferSubmittedMail::class
        ],
        OfferApproved::class => [
            OfferApprovedMail::class,
        ],
        OfferExpired::class => [
            OfferExpiredMail::class,
        ],
    ];

    protected $bindings = [
        NotificationsTemplateEntryModel::class => TemplateModel::class,
        NotificationsSmsnotifyEntryModel::class => SmsnotifyModel::class,
        NotificationsNotifyEntryModel::class => NotifyModel::class,
    ];

    protected $singletons = [
        TemplateRepositoryInterface::class => TemplateRepository::class,
        SmsnotifyRepositoryInterface::class => SmsnotifyRepository::class,
        NotifyRepositoryInterface::class => NotifyRepository::class,
    ];
}
