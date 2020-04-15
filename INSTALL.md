# Installation

## Server Requirements

- PHP >= 7.2
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
    
