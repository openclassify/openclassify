<?php namespace Visiosoft\NotificationsModule;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;

class NotificationsModuleSeeder extends Seeder
{
    public $templateRepository;

    public function __construct(TemplateRepositoryInterface $templateRepository)
    {
        $this->templateRepository = $templateRepository;
    }


    public $templates = [
        'created_ad' => [
            'slug' => 'created_ad',
            'en' => [
                'name' => 'Your uploaded ad has been created',
                'subject' => 'Your uploaded ad has been created',
                'greeting' => 'Hello',
                'message' => '<p><strong>&nbsp;<a href="{url}" target="_blank">{name}</a>&nbsp;your post has been successfully created.&nbsp;</strong></p>'
            ],
            'tr' => [
                'name' => 'Yüklediğiniz ilanınız oluşturuldu',
                'subject' => 'Yüklediğiniz ilanınız oluşturuldu',
                'greeting' => 'Merhaba',
                'message' => '<p><strong>&nbsp;<a href="{url}" target="_blank">{name}</a>&nbsp;gönderiniz başarıyla oluşturuldu.&nbsp;</strong></p>'
            ],
        ],
        'approved_ad' => [
            'slug' => 'approved_ad',
            'en' => [
                'name' => 'Your uploaded ad has been approved.',
                'subject' => 'Your uploaded ad has been approved.',
                'greeting' => 'Hello',
                'message' => '<p><strong>Your ad has been approved for :name.&nbsp;<a href="{url}" target="_blank">{name}</a></strong></p>'
            ],
            'tr' => [
                'name' => 'Yüklediğiniz ilanınız onaylandı',
                'subject' => 'Yüklediğiniz ilanınız onaylandı',
                'greeting' => 'Merhaba',
                'message' => '<p><strong>:name için ilanınız onaylandı.&nbsp;<a href="{url}" target="_blank">{name}</a></strong></p>'
            ],
        ],
        'declined_ad' => [
            'slug' => 'declined_ad',
            'en' => [
                'name' => 'Your uploaded ad has been rejected.',
                'subject' => 'Your uploaded ad has been rejected.',
                'greeting' => 'Hello',
                'message' => '<p><strong>Because your ad does not comply with the posting rules&nbsp;<a href="{url}" target="_blank">{name}</a>&nbsp;rejected.</strong></p>'
            ],
            'tr' => [
                'name' => 'Yüklediğiniz ilanınız reddedildi',
                'subject' => 'Yüklediğiniz ilanınız reddedildi',
                'greeting' => 'Merhaba',
                'message' => '<p><strong>İlanınız gönderim kurallarına uymadığı için&nbsp;<a href="{url}" target="_blank">{name}</a>&nbsp;reddedildi.</strong></p>'
            ],
        ],
        'pending_user_ad' => [
            'slug' => 'pending_user_ad',
            'en' => [
                'name' => 'Your Pending User post has been created',
                'subject' => 'Your Pending User post has been created',
                'greeting' => 'Hello',
                'message' => '<p><strong>Confirm your post to appear.&nbsp;<a href="{url}" target="_blank">{name}</a></strong></p>'
            ],
            'tr' => [
                'name' => 'Bekleyen Kullanıcı ilanınız oluşturuldu',
                'subject' => 'Bekleyen Kullanıcı ilanınız oluşturuldu',
                'greeting' => 'Merhaba',
                'message' => '<p><strong>Yayınınızın ortaya çıkması için onaylayınız.&nbsp;<a href="{url}" target="_blank">{name}</a></strong></p>'
            ],
        ],
        'pending_ad' => [
            'slug' => 'pending_ad',
            'en' => [
                'name' => 'Your Ad Pending Approval has been created',
                'subject' => 'Your Ad Pending Approval has been created',
                'greeting' => 'Hello',
                'message' => '<p><strong>Your post&nbsp;<a href="{url}" target="_blank">{name}</a>&nbsp;controlled by our editors.&nbsp;</strong></p>'
            ],
            'tr' => [
                'name' => 'Onay Bekleyen ilanınız oluşturuldu',
                'subject' => 'Onay Bekleyen ilanınız oluşturuldu',
                'greeting' => 'Merhaba',
                'message' => '<p><strong>Gönderiniz&nbsp;<a href="{url}" target="_blank">{name}</a>&nbsp;editörlerimiz tarafından kontrol edilmektedir.&nbsp;</strong></p>'
            ],
        ],
        'registered_user' => [
            'slug' => 'registered_user',
            'en' => [
                'name' => 'Registered User',
                'subject' => 'Your Membership Has Been Successfully Created',
                'greeting' => 'Hello {first_name}',
                'message' => '<p><strong>Your subscription has been activated.<br>Email:{email}</strong></p>'
            ],
            'tr' => [
                'name' => 'Kayıtlı Kullanıcı',
                'subject' => 'Üyeliğiniz Başarıyla Oluşturuldu',
                'greeting' => 'Merhaba Sayın {first_name}',
                'message' => '<p><strong>Üyeliğiniz aktive edildi.<br>E posta:{email}</strong></p>'
            ],
        ],
        'order_created' => [
            'slug' => 'order_created',
            'en' => [
                'name' => 'Order Created!',
                'subject' => 'Order Created!',
                'greeting' => 'Hello {display_name}',
                'message' => '<p class="text-center">Order Created!</p><p><br></p><p class="text-center">{items}</p><p><br></p><p class="text-center"><a href="{url}">Show </a>Order Detail</p><p><br></p>'
            ],
            'tr' => [
                'name' => 'Sipariş Oluşturuldu!',
                'subject' => 'Sipariş Oluşturuldu!',
                'greeting' => 'Merhaba {display_name}',
                'message' => '<p class="text-center">Sipariş Oluşturuldu!</p><p><br></p><p class="text-center">{items}</p><p><br></p><p class="text-center">Sipariş Detayını <a href="{url}"> Göster</a></p><p><br></p>'
            ],
        ],
        'message_notification' => [
            'slug' => 'message_notification',
            'en' => [
                'name' => 'Message Notification',
                'subject' => 'You have a new message',
                'greeting' => 'Hello',
                'message' => '<p><strong>You\'ve got a message {name}</strong></p><p>Message: {message}</p>'
            ],
            'tr' => [
                'name' => 'Mesaj Bildirimi',
                'subject' => 'Yeni mesajınız var',
                'greeting' => 'Merhaba',
                'message' => '<p><strong>Mesajınız var {name}</strong></p><p>Mesaj: {message}</p>'
            ],
        ],
        'created_refund_notification_for_user' => [
            'slug' => 'created_refund_notification_for_user',
            'en' => [
                'name' => 'Refund Notification Created for User',
                'subject' => 'Your Product Return Request Has Been Received',
                'greeting' => 'Hello',
                'message' => '<h1>Your Product Return Request Has Been Received!</h1><p>Your Product Return Request Has Been Received.&nbsp;<a href="{ad_url}">{ad_name}</a></p><p>Show Queue</p>'
            ],
            'tr' => [
                'name' => 'Kullanıcı İçin Geri Ödeme Bildirimi Oluşturuldu',
                'subject' => 'Ürün İade Talebiniz Alındı',
                'greeting' => 'Merhaba',
                'message' => '<h1>Ürün İade Talebiniz Alındı!</h1><p>Ürün iade talebiniz alındı.&nbsp;<a href="{ad_url}">{ad_name}</a></p><p>Sırayı Gösterin</p>'
            ],
        ],
        'created_refund_notification_for_seller' => [
            'slug' => 'created_refund_notification_for_seller',
            'en' => [
                'name' => 'Refund Notice Created for Seller',
                'subject' => 'Your product return request has been received!',
                'greeting' => 'Hello',
                'message' => '<h1>Your Product Return Request Has Been Received</h1><p>Your product return request has been received.&nbsp;<a href="{ad_url}">{ad_name}</a></p><p>Show Queue</p>'
            ],
            'tr' => [
                'name' => 'Satıcı İçin Geri Ödeme Bildirimi Oluşturuldu',
                'subject' => 'Ürün iade talebiniz alındı!',
                'greeting' => 'Merhaba',
                'message' => '<h1>Ürün İade Talebiniz Alındı</h1><p>Ürün iade talebiniz alındı.&nbsp;<a href="{ad_url}">{ad_name}</a></p><p>Sırayı Gösterin</p>'
            ],
        ],
        'created_refund_notification_for_admin' => [
            'slug' => 'created_refund_notification_for_admin',
            'en' => [
                'name' => 'Refund Notification Created for Manager.',
                'subject' => 'Return Request {ad_name}',
                'greeting' => 'Hello',
                'message' => '<h1>Return Request&nbsp;{ad_name}</h1><p>A return request has been created.&nbsp;<a href="{ad_url}">{ad_name}</a>.</p><p>Show Refund Request</p>'
            ],
            'tr' => [
                'name' => 'Yönetici İçin Geri Ödeme Bildirimi Oluşturuldu.',
                'subject' => 'İade Talebi {ad_name}',
                'greeting' => 'Merhaba',
                'message' => '<h1>İade Talebi&nbsp;{ad_name}</h1><p>Bir iade talebi oluşturuldu.&nbsp;<a href="{ad_url}">{ad_name}</a>.</p><p>Geri Ödeme İsteğini Gösterin</p>'
            ],
        ],
        'refund_status_changed_for_user' => [
            'slug' => 'refund_status_changed_for_user',
            'en' => [
                'name' => 'Refund Status Changed Notification for User',
                'subject' => 'Your Product Return Status Has Been Concluded.',
                'greeting' => 'Hello',
                'message' => '<h1>Your product return status has been concluded!</h1><p>Your product return status&nbsp;<a href="{ad_url}">{ad_name}</a>&nbsp;concluded.</p><p>{refund_message}</p><p>Show Queue</p>'
            ],
            'tr' => [
                'name' => 'Kullanıcı İçin Geri Ödeme Durumu Değişti Bildirimi',
                'subject' => 'Ürün İade Durumunuz Sonuçlandı.',
                'greeting' => 'Merhaba',
                'message' => '<h1>Ürün iade durumunuz sonuçlandı!</h1><p>Ürün iade durumunuz&nbsp;<a href="{ad_url}">{ad_name}</a>&nbsp;sonuçlandı.</p><p>{refund_message}</p><p>Sırayı Gösteriniz</p>'
            ],
        ],
        'refund_status_changed_for_seller' => [
            'slug' => 'refund_status_changed_for_seller',
            'en' => [
                'name' => 'Refund Status Changed Notification for Seller',
                'subject' => 'Product Return Status Changed.',
                'greeting' => 'Hello',
                'message' => '<h1>Product Return Status Changed</h1><p>Product return status&nbsp;<a href="{ad_url}">{ad_name}</a>&nbsp;changed.&nbsp;</p><p>{refund_message}</p><p>Show Queue</p>'
            ],
            'tr' => [
                'name' => 'Satıcı İçin Geri Ödeme Durumu Değişti Bildirimi',
                'subject' => 'Ürün İade Durumu Değiştirildi.',
                'greeting' => 'Merhaba',
                'message' => '<h1>Ürün İade Durumu Değiştirildi</h1><p>Ürün iade durumu&nbsp;<a href="{ad_url}">{ad_name}</a>&nbsp;değiştirildi.&nbsp;</p><p>{refund_message}</p><p>Sırayı Gösteriniz</p>'
            ],
        ],
        'refund_status_changed_for_admin' => [
            'slug' => 'refund_status_changed_for_admin',
            'en' => [
                'name' => 'Payment Status Changed Notification for Manager',
                'subject' => 'Payment Request Status Changed {ad_name}',
                'greeting' => 'Hello',
                'message' => '<h1>Product Return Status Changed.</h1><p>Product return status&nbsp;<a href="{ad_url}">{ad_name}</a>&nbsp;changed.&nbsp;</p><p>{refund_message}</p><p>Show Refund Request</p>'
            ],
            'tr' => [
                'name' => 'Yönetici İçin Ödeme Durumu Değişti Bildirimi',
                'subject' => 'Ödeme İsteği Durumu Değiştirildi {ad_name}',
                'greeting' => 'Merhaba',
                'message' => '<h1>Ürün İade Durumu Değiştirildi.</h1><p>Ürün iade durumu&nbsp;<a href="{ad_url}">{ad_name}</a>&nbsp;değiştirildi.&nbsp;</p><p>{refund_message}</p><p>Geri Ödeme İsteğini Göster</p>'
            ],
        ],
        'added_tracking_number' => [
            'slug' => 'added_tracking_number',
            'en' => [
                'name' => 'Added Tracking Number',
                'subject' => 'Your product has been shipped.',
                'greeting' => 'Hello',
                'message' => '<h1>{ad_name} product has been shipped.</h1><p>Shipping tracking number : <strong>{tracking_number}</strong></p><p>Estimated Arrival Day : <strong>{tracking_days}</strong></p><p>Transport Detail URL : <a href="{tracking_detail_url}">View shipping status</a></p><p><a href="{order_url}">View Order Detail</a></p>'
            ],
            'tr' => [
                'name' => 'Eklenen Takip Numarası',
                'subject' => 'Ürününüz kargolandı.',
                'greeting' => 'Merhaba',
                'message' => '<h1>{ad_name} ürününüz kargoya verildi.</h1><p>Kargo takip numarası : <strong>{tracking_number}</strong></p><p>Tahmini Varış Günü : <strong>{tracking_days}</strong></p><p>Transport Detail URL : <a href="{tracking_detail_url}">Kargo durumunu görüntüle</a></p><p><a href="{order_url}">Sipariş Detayını görüntüle</a></p>'
            ],
        ],
    ];

    /**
     * Run the seeder.
     */
    public function run()
    {
        foreach ($this->templates as $key => $template) {
            if (!$this->templateRepository->findBySlug($key)){
                $template['enabled'] = true;
                $template['stream'] = null;
                $template['view'] = null;
                $this->templateRepository->newQuery()->create($template);
                $this->command->info($key . ' notification template created...');
            }
        }

        $installed_modules = app('module.collection')->installed();
        $installed_modules = $installed_modules->merge(app('extension.collection')->installed());

        foreach ($installed_modules as $item) {

            $class = $item->getTransformedClass() . '\NotificationSeeder\NotificationSeeder';

            if (class_exists($class))
                $this->call($class);
        }
    }
}
