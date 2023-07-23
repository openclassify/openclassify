
## Via Composer

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

After installing, you may need to configure some permissions in order to proceed.
Directories within the `storage`, `public/app`, and the `bootstrap/cache` directories should be writable by your web server.
If you are using the [Homestead](http://laravel.com/docs/homestead) virtual machine, these permissions should already be set.


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
