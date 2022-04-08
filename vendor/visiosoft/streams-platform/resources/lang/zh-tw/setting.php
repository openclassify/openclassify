<?php

return [
    'name'             => [
        'label'        => '網站標題',
        'instructions' => '您的網站名稱？',
        'placeholder'  => trans('distribution::addon.name')
    ],
    'description'      => [
        'label'        => '網站說明',
        'instructions' => '您的網站說明或是標語？',
        'placeholder'  => trans('distribution::addon.description')
    ],
    'default_timezone' => [
        'label'        => '預設時區',
        'instructions' => '請設定系統的預設時區，這將會影響所有日期與時間的功能。'
    ],
    'date_format'      => [
        'label'        => '日期格式',
        'instructions' => '網站前後台的日期格式是？ 請參考 <a href="http://php.net/manual/en/function.date.php" target="_blank">date format</a> 在 PHP 網站中的說明。',
        'placeholder'  => 'm/d/Y'
    ],
    'time_format'      => [
        'label'        => '時間格式',
        'instructions' => '網站前後台的時間格式是？ 請參考 <a href="http://php.net/manual/en/function.date.php" target="_blank">date format</a> 在 PHP 網站中的說明。',
        'placeholder'  => 'g:i A'
    ],
    'default_locale'   => [
        'label'        => '預設語言',
        'instructions' => '您的網站預設語言是？'
    ],
    'enabled_locales'  => [
        'label'        => '使用語言',
        'instructions' => '您的網站可以支援那些語言？'
    ],
    'site_enabled'     => [
        'label'        => '網站開啟',
        'instructions' => '使用此選項來啟用或禁用網站前台。<br>當您需要暫時將網站關閉時，這將會很有用。'
    ],
    'ip_whitelist'     => [
        'label'        => 'IP 白名單',
        'instructions' => '當狀態設定為 "禁用" 時，這些 IP 才能允許存取這個網站。',
        'placeholder'  => '請使用半形字的逗點來區隔多個 IP。'
    ],
    '503_message'      => [
        'label'        => '無法存取時的顯示訊息',
        'instructions' => '當網站狀態設定為禁用或有重大問題產生時，此訊息將會顯示。',
        'placeholder'  => '馬上回來'
    ],
    'force_https'      => [
        'label'        => '強制 HTTPS',
        'instructions' => '只允許透過 HTTPS 通訊協定來使用網站。',
        'option'       => [
            'all'    => '強制 HTTPS 在所有的連線上。',
            'none'   => '不強制 HTTPS 連線。',
            'admin'  => '只強制 HTTPS 在後台的存取上。',
            'public' => '只強制 HTTPS 在前台的內容上。'
        ]
    ],
    'contact_email'    => [
        'label'        => '與我聯繫的電子郵件',
        'instructions' => '所有網站中來自用戶、訪客與系統的郵件，將會寄送到此預設的信箱。',
        'placeholder'  => 'example@domain.com'
    ],
    'server_email'     => [
        'label'        => '伺服器的電子郵件',
        'instructions' => '所有伺服器對外發出的郵件，將以此為寄件者。',
        'placeholder'  => 'noreply@domain.com'
    ],
    'mail_driver'      => [
        'label'        => '電子郵件的寄信程式',
        'instructions' => '您的網站將以什麼方式寄出信件？',
        'option'       => [
            'smtp'     => 'SMTP',
            'mail'     => 'PHP Mail',
            'sendmail' => 'Sendmail',
            'mailgun'  => 'Mailgun',
            'mandrill' => 'Mandrill',
            'log'      => 'Log File'
        ]
    ],
    'mail_host'        => [
        'label'        => 'SMTP Host',
        'instructions' => '您的網站將使用這個 SMTP server 來寄送郵件。',
        'placeholder'  => 'smtp.mailgun.org'
    ],
    'mail_port'        => [
        'label'        => 'SMTP Port',
        'instructions' => '您的網站將使用這個 SMTP port 來寄送郵件。',
        'placeholder'  => '587'
    ],
    'mail_username'    => [
        'label'        => 'SMTP Username',
        'instructions' => '您的網站將使用這個 SMTP username 來寄送郵件。'
    ],
    'mail_password'    => [
        'label'        => 'SMTP Password',
        'instructions' => '您的網站將使用這個 SMTP password 來寄送郵件。'
    ],
    'mail_debug'       => [
        'label'        => '偵錯模式',
        'instructions' => '當這個選項開啟時，郵件將不會被寄出，而是被寫入網站的記錄檔(log)，因此您可以檢查或偵錯。'
    ],
    'cache_driver'     => [
        'label'        => '暫存程式',
        'instructions' => '您的網站將用什麼方式暫存資料呢？',
        'option'       => [
            'apc'       => 'APC',
            'array'     => 'Array',
            'file'      => 'File',
            'memcached' => 'Memcached',
            'redis'     => 'Redis'
        ]
    ],
    'standard_theme'   => [
        'label'        => '前台模板',
        'instructions' => '您的網站前台要使用什麼風格模板呢？'
    ],
    'admin_theme'      => [
        'label'        => '後台模板',
        'instructions' => '您的網站後台要使用什麼風格模板呢？'
    ]
];
