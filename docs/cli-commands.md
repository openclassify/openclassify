# CLI Commands


## Asset Management

### assets:clear

Clears all asset and image generated cache.

The optional `path` argument specifies the path relative to your application's public asset path. In this way you can easily clear `public` or `admin` theme cache directories.
 
```bash
php artisan asset:clear         // Clear everything
php artisan asset:clear public  // Clear public theme cache
```


## View Management

### twig:clear

Clears all Twig related view cache.
 
```bash
php artisan twig:clear
```


## Cache Management

### cache:clear

Clears all framework cache. Does not include HTTP cache.
 
```bash
php artisan cache:clear
```

## HTTP Cache

### httpcache:clear

Clears all HTTP cache.
 
```bash
php artisan httpcache:clear
```

### httpcache:warm

Warms HTTP cache by crawling your sitemap.

The `--sleep` option specifies how long in `seconds` to wait between each request. HTTP cache will be warmed as fast as possible by default.

The `--clear` flag will call `httpcache:clear` prior to warming.
 
```bash
php artisan httpcache:warm --sleep=5 --clear
```


## Application Commands

### env:set

Set a `.env` value. Specify the `like` to update or insert like this: 
 
```bash
php artisan env:set APP_DEBUG=true
```

### app:publish

Copy the base `.env` and generate a `routes.php` file in the application's `resources` directory.
 
Use the `--force` flag to overwrite the files should they already exist.  
 
```bash
php artisan app:publish --force
```

### streams:publish

Copy the configuration, language files, and views from the Streams Platform into `resources/streams` so that you can modify them to override core and commit the changes safely to your version control.
 
Use the `--force` flag to overwrite the files should they already exist.  
 
```bash
php artisan streams:publish --force
```

### build

Compile Streams models and signal to others components that the system is building.
 
```bash
php artisan build
```

### refresh

Refreshes all caches and signals to other components to refresh as well.  
 
```bash
php artisan build
```


## Streams Commands

### make:stream

Create a scaffold a new stream.

The `stream` argument should be a **plural slug identifier** for the stream like `books` or `favorite_books`.
 
The `addon` argument must be a unique module or extension identifier like a `dot namespace` or `slug`. The stream classes will be generated in the addon's `src` directory. 

The `--namespace` option may be used to specify a namespace for the stream like `--namespace=book_store`. The slug of the specified `addon` will be used by default. 

> The addon must be created using [make:addon](#make-addon) prior to running this command.{.notice}
 
```bash
php artisan make:stream books anomaly.module.store
```

### streams:index

Import `searchable` stream entries into the search index. 

Use the optional `namespace` argument to index stream entries within that namespace only.
 
Use the optional `stream` argument to target entries for a specific stream with the `namespace`. 

The `--flush` flag may be used flush the search index before importing.
 
```bash
php artisan streams:index                       // Import everything searchable
php artisan streams:index products books        // Import books
```

### streams:compile

Compile the base generated models for all streams from their database values.
 
```bash
php artisan streams:compile
```

### streams:cleanup

Safely deletes any "abandoned" or otherwise garbage streams, fields, and assignments that might present themselves during or after development. 
 
```bash
php artisan streams:cleanup
```

### streams:destroy

Destroy all streams, fields, and assignments within a given `namespace`. 
 
```bash
php artisan streams:destroy store
```


## Addon Commands

### make:addon

Create an addon with everything you need to start development.

The `namespace` argument looks like `{vendor}.{type}.{addon}` and specifies the addon's `vendor` slug, the `type` slug, and the `addon` slug of the desired addon to create. 

The `vendor` slug should reflect you as an author. The `vendor` slug used by the creators of the Streams Platform for example is `anomaly`.

Supported `type` slugs are `module`, `theme`, `extension`, `plugin`, and `field_type`.
 
The `addon` slug is the `slug_formatted` name of the addon you are creating.
 
```bash
php artisan make:addon anomaly.module.store
```

### addon:install

Install an addon. 

The required `addon` argument must be an addon identifier like `anomaly.module.store`. 

The `--seed` flag causes the addon to be seeded as well.

> Only **modules** and **extensions** are installable.{.notice}
 
```bash
php artisan addon:install anomaly.module.store --seed
```

### addon:uninstall

Uninstall an addon. 

The required `addon` argument must be an addon identifier like `anomaly.module.store`. 

> Only **modules** and **extensions** are installable.{.notice}
 
```bash
php artisan addon:uninstall anomaly.module.store --seed
```

### addon:reinstall

Reinstall an addon. 

The required `addon` argument must be an addon identifier like `anomaly.module.store`. 

> Only **modules** and **extensions** are installable.{.notice}
 
```bash
php artisan addon:reinstall anomaly.module.store --seed
```

### addon:publish

Copy the configuration, language files, and views from the specified `addon` into `resources/streams` so that you can modify them to override the addon and commit the changes safely to your version control.

The required `addon` argument must be an addon identifier like `anomaly.module.store`.

Use the `--force` flag to overwrite the files should they already exist.
 
```bash
php artisan addon:publish anomaly.module.store --force
```
