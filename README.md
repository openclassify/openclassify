<br>
<p align="center">
  <a href="https://openclassify.com"><img src="https://raw.githubusercontent.com/openclassify/openclassify/master/public/openclassify-logo.png" width="250" alt="Openclassify Logo"></a>
</p>
<br>
<p align="center">
<a href="https://packagist.org/packages/openclassify/openclassify" target="_blank"><img class="badge" src="http://poser.pugx.org/openclassify/openclassify/v"></a>
<a href="https://packagist.org/packages/openclassify/openclassify" target="_blank"><img class="badge" src="http://poser.pugx.org/openclassify/openclassify/downloads"></a>
<a href="https://packagist.org/packages/openclassify/openclassify" target="_blank"><img class="badge" src="http://poser.pugx.org/openclassify/openclassify/license"></a>
<a href="https://scrutinizer-ci.com/g/openclassify/openclassify/?branch=master" rel="nofollow"><img src="https://camo.githubusercontent.com/b1809c56d5b15765dabaf72c173e7f9aba9e7b721ccb0036e9db5da62869e6b1/68747470733a2f2f7363727574696e697a65722d63692e636f6d2f672f6f70656e636c6173736966792f6f70656e636c6173736966792f6261646765732f7175616c6974792d73636f72652e706e673f623d6d6173746572" alt="Scrutinizer Code Quality" data-canonical-src="https://scrutinizer-ci.com/g/openclassify/openclassify/badges/quality-score.png?b=master" style="max-width: 100%;"></a>
<a href="https://scrutinizer-ci.com/g/openclassify/openclassify/build-status/master" rel="nofollow"><img src="https://camo.githubusercontent.com/07509845a0eab157141235a794cd09967425222639d63d640d689763250f0da3/68747470733a2f2f7363727574696e697a65722d63692e636f6d2f672f6f70656e636c6173736966792f6f70656e636c6173736966792f6261646765732f6275696c642e706e673f623d6d6173746572" alt="Build Status" data-canonical-src="https://scrutinizer-ci.com/g/openclassify/openclassify/badges/build.png?b=master" style="max-width: 100%;"></a>
<a href="https://scrutinizer-ci.com/code-intelligence" rel="nofollow"><img src="https://camo.githubusercontent.com/9fcde20119b3a44e430ad50f1bb3c2db3db753df9c3b2ade5cd14217a0a971ab/68747470733a2f2f7363727574696e697a65722d63692e636f6d2f672f6f70656e636c6173736966792f6f70656e636c6173736966792f6261646765732f636f64652d696e74656c6c6967656e63652e7376673f623d6d6173746572" alt="Code Intelligence Status" data-canonical-src="https://scrutinizer-ci.com/g/openclassify/openclassify/badges/code-intelligence.svg?b=master" style="max-width: 100%;"></a>
</p>



## About OpenClassify

OpenClassify is modular and most advanced open source classified platform build with Laravel 8 & PHP 8.1 Supported. Included Pyrocms 3.9


## Translation

Openclassify support 22+ languages. If you'd like to contribute translations, please check out our [Crowdin](https://crowdin.com/project/openclassify) project.

## Server Requirements

- Supports PHP 7.3 and later (8.1 Supported)
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
 
 
## Via Composer

> Do not create an `.env` file just yet - Installer will generate one for you.{.important}

```bash
composer create-project openclassify/openclassify
```

### Via Docker

We suggest to use Docker.

https://github.com/openclassify/openclassify/wiki/Installing-Openclassify-on-windows-docker-desktop

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


## Installation 

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

## CLI Commands

If you couldn't find a solution for any problem, please review our CLI Command document.
[View CLI Command Document](https://github.com/openclassify/openclassify/blob/master/docs/cli-commands.md)

## Code Contributors

This project exists thanks to all the people who [contribute](https://github.com/openclassify/openclassify/graphs/contributors) and more.

<p align="center">

<a href = "https://github.com/openclassify/openclassify/graphs/contributors">
  <img src = "https://contrib.rocks/image?repo=openclassify/openclassify"/>
</a>

</p>

Thanks to Ryan and his stream platform PyroCMS which makes OpenClassify more powerful.
