<?php

return [
    'name'                  => [
        'label'        => 'Site Adı',
        'instructions' => 'Başvurunuzun adı nedir?',
        'placeholder'  => trans('distribution::addon.name'),
    ],
    'description'           => [
        'label'        => 'Site Açıklaması',
        'instructions' => 'Başvurunuzun açıklaması veya sloganı nedir?',
        'placeholder'  => trans('distribution::addon.description'),
    ],
    'domain'                => [
        'label'        => 'Birincil Alan Adı',
        'instructions' => 'Başvurunuzun birincil nedir?',
        'placeholder'  => 'domain.com',
    ],
    'force_ssl'             => [
        'label'        => 'SSL\'yi zorla',
        'instructions' => 'Tüm gelen bağlantılar için SSL\'yi zorlamak ister misiniz?',
    ],
    'domain_prefix'         => [
        'label'        => 'Etki Alanı Öneki',
        'instructions' => 'Bir etki alanı öneki zorlamak istiyor musunuz?',
        'placeholder'  => 'Tercih yok',
    ],
    'timezone'              => [
        'label'        => 'Saat dilimi',
        'instructions' => 'Siteniz için varsayılan saat dilimini belirtin.',
    ],
    'unit_system'           => [
        'label'        => 'Birim sistemi',
        'instructions' => 'Siteniz için birim sistemi belirtin.',
        'option'       => [
            'imperial' => 'Imparatorluk sistemi',
            'metric'   => 'Metrik sistemi',
        ],
    ],
    'currency'              => [
        'label'        => 'Para birimi',
        'instructions' => 'Siteniz için varsayılan para birimini belirtin.',
    ],
    'date_format'           => [
        'label'        => 'Tarih formatı',
        'instructions' => 'Siteniz için varsayılan tarih biçimini belirtin.',
    ],
    'time_format'           => [
        'label'        => 'Zaman formatı',
        'instructions' => 'Siteniz için varsayılan zaman biçimini belirtin.',
    ],
    'default_locale'        => [
        'label'        => 'Dil',
        'instructions' => 'Siteniz için varsayılan dili belirtin.',
    ],
    'enabled_locales'       => [
        'label'        => 'Etkin diller',
        'instructions' => 'Siteniz için hangi dillerin uygun olduğunu belirtin.',
    ],
    'maintenance'           => [
        'label'        => 'Bakım Modu',
        'instructions' => 'Sistemin halka bakan kısmını devre dışı bırakmak için bu seçeneği kullanın.<br>Bu, siteyi bakım veya geliştirme amacıyla almak istediğinizde kullanışlıdır.',
    ],
    'debug'                 => [
        'label'        => 'Hata ayıklama modu',
        'instructions' => 'Etkinleştirildiğinde, hatalarda ayrıntılı mesajlar görüntülenir.',
    ],
    'debug_bar'             => [
        'label'        => 'Hata ayıklama çubuğu',
        'instructions' => 'Etkinleştirildiğinde, ekranın altında ayrıntılı istek günlükleri görüntülenir.',
    ],
    'ip_whitelist'          => [
        'label'        => 'IP Beyaz Listesi',
        'instructions' => 'Bakım modu etkinleştirildiğinde, bu IP adreslerinin uygulamanın önüne erişmesine izin verilir.',
        'placeholder'  => 'Her IP adresini virgül ile ayırın.',
    ],
    'basic_auth'            => [
        'label'        => 'Kimlik doğrulama istemi?',
        'instructions' => 'Bakım modu etkinleştirildiğinde, kullanıcılardan HTTP kimlik doğrulaması isteyin mi?',
    ],
    '503_message'           => [
        'label'        => 'Kullanılamayan Mesaj',
        'instructions' => 'Site devre dışı bırakıldığında veya büyük bir sorun olduğunda, bu mesaj kullanıcılara gösterilecektir.',
        'placeholder'  => 'Hemen dönecek.',
    ],
    'email'                 => [
        'label'        => 'Sistem E-postası',
        'instructions' => 'Sistem tarafından üretilen mesajlar için kullanılacak varsayılan e-postayı belirtin.',
        'placeholder'  => 'example@domain.com',
    ],
    'sender'                => [
        'label'        => 'Gönderenin adı',
        'instructions' => 'Sistem tarafından üretilen mesajlar için kullanılacak "Kimden" adını belirtin.',
    ],
    'standard_theme'        => [
        'label'        => 'Genel Tema',
        'instructions' => 'Halka açık site için hangi temayı kullanmak istersiniz?',
    ],
    'admin_theme'           => [
        'label'        => 'Yönetici Teması',
        'instructions' => 'Kontrol paneli için hangi temayı kullanmak istersiniz?',
    ],
    'per_page'              => [
        'label'        => 'Sayfa başına sonuç',
        'instructions' => 'Her sayfada gösterilecek varsayılan sonuç sayısını belirtin.',
    ],
    'mail_driver'           => [
        'label'        => 'Email Sürücüsü',
        'instructions' => 'Uygulamanız nasıl e-posta gönderir?',
        'option'       => [
            'smtp'     => 'SMTP',
            'mail'     => 'PHP Mail',
            'sendmail' => 'Posta göndermek',
            'mailgun'  => 'Mailgun',
            'mandrill' => 'Mandrill',
            'log'      => 'Log dosyası',
        ],
    ],
    'mail_host'             => [
        'label'        => 'SMTP Sunucusu',
        'instructions' => 'Kullanılacak SMTP ana bilgisayarını belirtin.',
        'placeholder'  => 'smtp.mailgun.org',
    ],
    'mail_port'             => [
        'label'        => 'SMTP Bağlantı Noktası',
        'instructions' => 'Kullanılacak SMTP bağlantı noktasını belirtin.',
        'placeholder'  => '587',
    ],
    'mail_username'         => [
        'label'        => 'SMTP Kullanıcı Adı',
        'instructions' => 'Kullanılacak SMTP kullanıcı adını belirtin.',
    ],
    'mail_password'         => [
        'label'        => 'SMTP Şifresi',
        'instructions' => 'Kullanılacak SMTP şifresini belirtin.',
    ],
    'http_cache'            => [
        'label'        => 'HTTP Önbelleği',
        'instructions' => 'HTTP önbelleğini etkinleştirmek istiyor musunuz?',
        'warning'      => 'Devre dışı bırakmak, HTTP önbellek depolamasını temizler.',
    ],
    'http_cache_ttl'        => [
        'label'        => 'Varsayılan TTL',
        'instructions' => 'Varsayılan önbellek süresini saniye cinsinden belirtin.',
    ],
    'http_cache_allow_bots' => [
        'label'        => 'Bot Politikası',
        'instructions' => 'Botlara izin ver <em>üretmek</em> önbellek dosyaları?',
        'warning'      => 'Botlar, daha önce oluşturulmuş önbellek dosyalarında hizmet vermeye devam edecek.',
    ],
    'http_cache_excluded'   => [
        'label'        => 'Dışlanan Yollar',
        'instructions' => 'Her yolu yeni bir satıra belirtin. Kısmi eşleme için "*" kullanın.',
        'placeholder'  => '/hesap/*',
    ],
    'http_cache_rules'      => [
        'label'        => 'Zaman Aşımı Kuralları',
        'instructions' => 'Her birini belirtin <strong>TTL yolu</strong> yeni bir hatta. Kısmi eşleme için "*" kullanın.',
        'placeholder'  => '/haber/* 1800',
    ],
    'db_cache'              => [
        'label'        => 'Veritabanı Önbelleği',
        'instructions' => 'Veritabanı sorgu önbelleğe almayı etkinleştirmek ister misiniz?',
    ],
    'db_cache_ttl'          => [
        'label'        => 'Varsayılan TTL',
        'instructions' => 'Varsayılan önbellek süresini saniye cinsinden belirtin.',
    ],
    'locking_enabled'       => [
        'label'        => 'İçerik Kilitleme
',
        'instructions' => 'Birden fazla kullanıcının aynı içeriği aynı anda değiştirmesini engelleme',
    ],
];
