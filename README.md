# OpenClassify -  Laravel 8 Classified Script Platform

OpenClassify is modular and most advanced open source classified platform build with Laravel 8 & PHP 7.3+ Supported. Included Pyrocms 3.9



[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/openclassify/openclassify/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/openclassify/openclassify/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/openclassify/openclassify/badges/build.png?b=master)](https://scrutinizer-ci.com/g/openclassify/openclassify/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/openclassify/openclassify/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
 

<div align="center">
 <a href="https://openclassify.com">
    <img src="https://repository-images.githubusercontent.com/193061961/48452600-72c0-11ea-88f5-77566c3527eb">
  </a>
</div>
 


[!['Preview Homapage Classified Script'](https://openclassify.com/files/images/open.jpg)](https://openclassify.com/)

## Translation

Openclassify support 22+ languages. If you'd like to contribute translations, please check out our [Crowdin](https://crowdin.com/project/openclassify) project.

# Installation

## Server Requirements

- PHP > 7.3+
- XML PHP Extension
- PDO PHP Extension
- cURL PHP Extension
- JSON PHP Extension
- Ctype PHP Extension
- BCMath PHP Extension
- SQLite PHP Extension
- OpenSSL PHP Extension
- Mbstring PHP Extension
- Fileinfo PHP Extension
- Tokenizer PHP Extension
- GD Library (>=2.0) **OR** Imagick PHP extension (>=6.5.7)
 
### Via Composer

> Do not create an `.env` file just yet - Installer will generate one for you.{.important}

```bash
composer create-project openclassify/openclassify
```

### Host Configuration

When you setup your web host be sure to point the web root to `public` directory. Just as you would a normal Laravel installation.

#### Alternate Directories for cPanel or Virtualmin

In some environments like cPanel or Virtualmin it may be difficult to use the `public` directory as the web root. In these cases we suggest symlinking the `public` directory to `public_html`:

```bash
ln -s public public_html
```

You may also simply rename the `public` directory to `public_html`. Path hints will automatically use the correct path. 

### Directory Permissions

After installing, you may need to configure some permissions in order to proceed. Directories within the `storage`, `public/app`, and the `bootstrap/cache` directories should be writable by your web server. If you are using the [Homestead](http://laravel.com/docs/homestead) virtual machine, these permissions should already be set.


## Installing 

### Running the Installation Wizard

After downloading and it's dependencies with:

```bash
composer install
```
you will need to install the software in order to get started. 
By this time you should be able to visit your site's URL which will
 redirect you to the installer: `http://yoursite.com/installer`

### Using the CLI Installer


```bash
php artisan install

```

You will be prompted for details in order to proceed with the installation process.

> You may need to run `ulimit -n 1024` before installing via CLI to temporarily increase your max open files limit.

#### Automating the CLI Installer

You can automate the installer by creating your own .env file with something like this:

```bash
APP_ENV=local
APP_DEBUG=true
APP_KEY=zfesbnTkXvooWVcsKMw2r4SmPVNGbFoS
DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=workbench
DB_USERNAME=root
DB_PASSWORD=root
APPLICATION_NAME=Default
APPLICATION_REFERENCE=default
APPLICATION_DOMAIN=localhost
ADMIN_EMAIL=info@openclassify.com
ADMIN_USERNAME=admin
ADMIN_PASSWORD=password
LOCALE=en
TIMEZONE=Turkey/Istanbul
```
> The APP_KEY must be exactly 32 characters in length.

Then run the installer and indicate that the system is ready to install:

```bash
php artisan install --ready
```                             
 
    
## Development Team

Samed Durak @profstyle1

Vedat Akdoğan  @vedatakd

Onur Üre @onurure

Fatih Alp @fatihalp

Emek Sancar @emeksancar

Ozcan Durak @ozcandurak

Dia @diashalabi

## Thanks to

Ryan and it's  stream platform and pyrocms it makes OpenClassify more powerfull. 
