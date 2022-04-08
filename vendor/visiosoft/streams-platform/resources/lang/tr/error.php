<?php

return [
    '400' => [
        'name'    => 'Geçersiz istek',
        'message' => 'Kötü sözdizimi nedeniyle istek yerine getirilemiyor.',
    ],
    '401' => [
        'name'    => 'Yetkisiz',
        'message' => 'Kimlik doğrulaması gerekli ve başarısız oldu veya henüz sağlanmadı.',
    ],
    '402' => [
        'name'    => 'Ödeme gerekli',
        'message' => 'Ödeme gerekli ve başarısız oldu veya henüz sağlanmadı.',
    ],
    '403' => [
        'name'    => 'Yasaklanmış',
        'message' => 'İstek geçerli bir istekdi, ancak sunucu yanıt vermeyi reddediyor.',
    ],
    '404' => [
        'name'    => 'Bulunamadı',
        'message' => 'İstenen kaynak bulunamadı, ancak gelecekte tekrar kullanılabilir.',
    ],
    '405' => [
        'name'    => 'İzin verilmeyen yöntem',
        'message' => 'Bir kaynak, bu kaynak tarafından desteklenmeyen bir istek yöntemi kullanılarak yapıldı.',
    ],
    '406' => [
        'name'    => 'Kabul edilemez',
        'message' => 'İstenen kaynak yalnızca kabul edilemez içerik üretme yeteneğine sahiptir.',
    ],
    '408' => [
        'name'    => 'İstek zaman aşımına uğradı',
        'message' => 'Sunucu zamanında tam bir istek mesajı almadı.',
    ],
    '409' => [
        'name'    => 'Fikir ayrılığı',
        'message' => 'İstek, istekteki uyuşmazlık nedeniyle işlenemedi.',
    ],
    '410' => [
        'name'    => 'Gitmiş',
        'message' => 'İstenen kaynak artık mevcut değil ve bir daha bulunamayacak.',
    ],
    '411' => [
        'name'    => 'Gerekli Uzunluk',
        'message' => 'İstek, kaynağın gerektirdiği içeriğinin uzunluğunu belirtmedi.',
    ],
    '412' => [
        'name'    => 'Önkoşul Başarısız',
        'message' => 'Sunucu, talep edenin istek üzerine koyduğu ön koşullardan birini karşılamıyor.',
    ],
    '413' => [
        'name'    => 'Sunucu isteği sağlanamadı',
        'message' => 'Sunucu, istek yükü çok büyük olduğu için isteği işleyemiyor.',
    ],
    '414' => [
        'name'    => 'URI Çok Uzun',
        'message' => 'İstek hedefi, sunucunun yorumlamak istediğinden daha uzun.',
    ],
    '415' => [
        'name'    => 'Desteklenmeyen Medya Türü',
        'message' => 'İstek varlığı, sunucu veya kaynağın desteklemediği bir medya türüne sahiptir.',
    ],
    '417' => [
        'name'    => 'Beklenti Başarısız',
        'message' => 'Verilen beklenti, gelen sunuculardan en az biri tarafından karşılanamadı.',
    ],
    '422' => [
        'name'    => 'İşlenemeyen Varlık',
        'message' => 'İstek iyi biçimlendirildi, ancak anlamsal hatalardan dolayı izlenemedi.',
    ],
    '426' => [
        'name'    => 'Yükseltme Gerekli',
        'message' => 'Sunucu, mevcut protokolü kullanarak isteği işleyemez.',
    ],
    '428' => [
        'name'    => 'Önkoşul Gerekli',
        'message' => 'Kaynak sunucu, isteğin koşullu olmasını gerektirir.',
    ],
    '429' => [
        'name'    => 'Çok fazla istek',
        'message' => 'Kullanıcı, belirli bir süre içinde çok fazla istek gönderdi.',
    ],
    '500' => [
        'name'    => 'İç Sunucu Hatası',
        'message' => 'Bir hata oluştu ve bu kaynak görüntülenemiyor.',
    ],
    '501' => [
        'name'    => 'Uygulanmadı',
        'message' => 'Sunucu, istek yöntemini tanımıyor veya isteği gerçekleştirme yeteneğinden yoksun.',
    ],
    '502' => [
        'name'    => 'Kötü ağ geçidi',
        'message' => 'Sunucu bir ağ geçidi veya proxy gibi davranıyordu ve yukarı akış sunucusundan geçersiz bir yanıt aldı.',
    ],
    '503' => [
        'name'    => 'Hizmet kullanılamıyor',
        'message' => 'Sunucu şu anda kullanılamıyor. Bakım için aşırı yüklenebilir veya düşebilir.',
    ],
    '504' => [
        'name'    => 'Ağ Geçidi Zaman Aşımı',
        'message' => 'Sunucu bir ağ geçidi veya proxy gibi davranıyordu ve yukarı akış sunucusundan zamanında bir yanıt alamadı.',
    ],
    '505' => [
        'name'    => 'HTTP Sürümü Desteklenmiyor',
        'message' => 'Sunucu, istekte kullanılan HTTP protokolü sürümünü desteklemiyor.',
    ],
];
