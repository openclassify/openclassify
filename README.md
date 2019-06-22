# OpenClassify

OpenClassify is the extensible and most advanced open source classified app build with Laravel.

# Core Modules

advs-module
cats-module
default-theme
defaultadmin-theme
json-field_type
location-module
media-field_type
profile-module
single-file_type


### Extensions used by OpenClassify to install to ubuntu php 7.2
```
sudo apt-get install php7.2-sqlite
```

```
sudo apt-get install php7.2-bcmath
```
## Docker Enviroment


Requirements 

* [Git](https://git-scm.com/downloads)
* [Docker](https://docs.docker.com/engine/installation/)
* [Docker Compose](https://docs.docker.com/compose/install/)

Check if `docker-compose` is already installed by entering the following command : 

```sh
which docker-compose
```

Check Docker Compose compatibility :

* [Compose file version 3 reference](https://docs.docker.com/compose/compose-file/)

The following is optional but makes life more enjoyable :

```sh
which make
```

On Ubuntu and Debian these are available in the meta-package build-essential. On other distributions, you may need to install the GNU C++ compiler separately.

```sh
sudo apt install build-essential
```
## Running The application

1. Start the application :

    ```sh
    sudo docker-compose up -d
    ```

    **Please wait this might take a several minutes...**

    ```sh
    sudo docker-compose logs -f # Follow log output
    ``` 
    **Add these line in your .env file ...**

     ```sh
   # Nginx
   NGINX_HOST=localhost
   
   # PHP
   
   # See https://hub.docker.com/r/nanoninja/php-fpm/tags/
   PHP_VERSION=latest
   
   # MySQL 
   MYSQL_VERSION=5.7.22  //Keep this up as your requirements
   MYSQL_HOST=mysql
   MYSQL_DATABASE=your_db_name
   MYSQL_ROOT_USER=root
   MYSQL_ROOT_PASSWORD=root
   MYSQL_USER=dev
   MYSQL_PASSWORD=dev
    ```
    
   **Replace these line in your .env file ...**

   ```sh
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=your_db_name
    DB_USERNAME=root
    DB_PASSWORD=root
    ```

3. Open your favorite browser :

    * [http://localhost:8000](http://localhost:8000/)
    * [http://localhost:8080](http://localhost:8080/) PHPMyAdmin (username: dev, password: dev)

4. Stop and clear services

    ```sh
    sudo docker-compose down -v
    ```
___



## Module ekleme

Visiosoft -> bulunduğu klasör adı. Herhangi bir şey olabilir
Advs -> modülün adı

— php artisan make:addon visiosoft.module.advs

Bundan sonra 

Addons/default/visiosoft/advs-module klasörü oluşacaktır.

yukarıdaki dosya yolunda migration klasörünün içerisinde otomatik oluşan bir migration dosyası olacak.

Bu örnek için
tarih__visiosoft.module.advs__create_advs_fields.php

Bunun içine tüm modülde kullanacak fieldları girilmeli

Örnek olarak

        
    protected $fields = [
		'name' => 'anomaly.field_type.text',
        'category' => [
            'type' => 'anomaly.field_type.relationship',
            'config' => [
                'related' => CategoryModel::class
            ]
        ]
	]

Daha sonra önce ana tablo ve sonrasında diğer tablolar eklenmeli. Sıra önemli yanlış sırada route sapıtıyor.

php artisan make:stream advs advs

İle ana kategori dosyaları ve migration ı yaratılıyor daha sonra 

php artisan make:stream categories advs

İle bağlı olan diğer kısım

Oluşan migrationlar içerisine field özellikleri giriliyor.

Örn:

    protected $stream = [
        'slug' => 'advs',
         'title_column' => 'name',
         'translatable' => true,
         'trashable' => false,
         'searchable' => false,
         'sortable' => false,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'name' => [
            'translatable' => true,
            'required' => true,
        ],
        'slug' => [
            'unique' => true,
            'required' => true,
        ],
        'advs_desc',
        'category',
        'price',
        'currency',
        'online_payment',
        'stock',
        'files'
    ];

Bu bölümler hazır olduktan sonra 

Php artisan addon:install advs 

İle module sisteme yükleniyor.

Modülde değişiklik yapılacaksa eğer

Öncelikle php artisan addonn:uninstall advs 

Yazılarak modül silinip değişiklikten sonra tekrar yüklenmeli

Multilanguage için öncelikle  sitenin settings->system bölümünden istenilen diller aktif edilmeli.

static bölümlerin translate (laravel gibi) her modülün içinde olan resources/lang/ içinden yapılıyor.

Dinamik alanlar ise ayarlardan multilanguage aktifleştirilince her inputun labelinde bulunan dropdown ile yapılıyor

## Proje kurulurken dikkat edilmesi gereken husus

Gelistirme sureci icin proje kurulurken, application name in default olarak ayarlanmasi gerekiyor, bu sekilde ayarlanmadigi takdirde addonlar gozukmeyecektir.

## Custom view lar ile ilgili...
Custom view tanimlayip modulun icinden ulasilmak istenildiginde yapilmasi gerekenler:
1) addons/default/visiosoft/modulename/resources/views altina custom bir view dosyasi aciyoruz
2) controllerdan bu view a ulasmak icin $this->view->make('visiosoft.module.modulename::modulename/list'); komutunu kullanabiliriz, hata vermemesi icin
kullanilan controller'in PublicController class ina extends edilmesi gerekebilir.
3) kodun visiosoft.module.modulename kismi, alinda addons/default/visiosoft/modulename/resources/views kismini isaret etmektedir.

## manuel addon ekleme

klasör addon altına kopyalanır ve mutlaka composer dump-autoload yapılmalıdır.

## modül seed yüklemek için

php artisan db:seed --addon=modül_adi

## modül ve seed yüklemek için

php artisan addon:install modül_adi --seed

OR

php artisan addon:reinstall modül_adi --seed

## Ajax Loader Eklemek

İşlem süresinde kullancıyı loader eklentisi göstererek hem şık bir görüntü hemde boş veri göstermemiş oluruz.
Loader Ajax Global Fonksiyonu Aşağıdaki örnekte verilmiştir.

Örn:

    $.ajax({
            type: 'get',
            url: '/class/getcats/'+ divId,
            success: function (response) {
                hideLoader() // işlem bşarılı olursa loader gizle
            },
            beforeSend: function () {
                showLoader() // işlem süresince loader göster
            }
        })
        
         protected $options = [
                'redirect' => '/admin/cloudsite',
                'success_message'   => 'visiosoft.module.cloudsite::message.created_site.message',
            ];
            
            
            
## Önyüzde Uyarılar

İşlem sonucunda uyarı göstermek istenebilir.Uyarılar builder'da veya Redirect olarak 2 farklı şekilde gönderilebilir.

FormBuilder Örn:
        
         protected $options = [
                'redirect' => '/admin/cloudsite',
                'success_message'   => 'visiosoft.module.cloudsite::message.created_site.message',
            ];
Controller/Redirect Veya Controller/Return  Örn:
        
         return redirect('admin/cats')->with('success', ['Message1.','Message2',...]);
         
         //OR
                                      ->with('error', ['Message1.','Message2',...]);
         //OR
                                      ->with('warning', ['Message1.','Message2',...]);
         //OR
                                      ->with('info', ['Message1.','Message2',...]);          
                                      
## Önyüzde Form Builder ileOluşturulan bir form elemanına required özelliği atama


currency Örn:
        
         <div class="col-sm-3 col-xs-6">
             {{ form.fields.currency.setAttributes({'required' :true,}).input|raw }}
         </div>
             
             
## Table Builder query kullanımı
   
    //AdvsTableBuilder.php     
        public function onQuerying(Builder $query)
            {
                $query->where('slug', "!=", NULL);
            }                                                                   