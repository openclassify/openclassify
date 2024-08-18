# OpenClassify Custom Field Module

OpenClassify Custom Field Module ilan detay kısmı için oluşturulacak kategori bazlı extra bilgi tutan kısımdır.

# Frontend

Modül aktif ise ilan girilirken yönetici tarafından ilan kategorisine atanmış fieldları gösterir ve veri girilmesini sağlar. Girilen verilere göre ilan detay sayfasında bilgiler feature tabında gelecektir. Ayrıca modül aktif ise seçilen "select" ve "checkbox" fieldları sol taraftaki filtre kolonunda görünecektir. "selecttop" field seçilmesi durumunda ise yönetim panelinden bu field için girilen veriler listeleme ekranının üst kısmında hızlı filtreleme olarak gelecektir. İstelen custom fieldlar yine listemeleme ekranında tablo görünümünde yer alacaktır.


# Admin

Admin panelinde custom fields tabında yeni custom fieldlar kategori bazlı oluşturulabilir. Seçilen custom field eğer "select", "selecttop" ve "checkbox" ise bunların önyüzde görünmesi için "CFvalue" tabından değerlerinin girilmesi gereklidir. Aksi taktirde bu fieldlar görünmeyecektir. 

# Dosyalar

listeleme ekranı tablo görüntüsüne tablo başlık addons/default/visiosoft/customfields-module/resources/views/cftable.twig
listeleme ekranı tablo görüntüsüne ekleme addons/default/visiosoft/customfields-module/resources/views/cftablerow.twig
listeleme ekranı üst kısım hızlı filtre addons/default/visiosoft/customfields-module/resources/views/selecttop.twig

içerisinden düzenlenemebilir

# Gerekli modul

Sadece Advs Modülü gereklidir.