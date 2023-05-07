#!/bin/bash

echo "$APP_ENV" 

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
else
    echo "composer. nothing to do."    
fi

if [ ! -f ".env" ]; then
    echo "Creating env file for env $APP_ENV from env-sail"
    cp .env-sail .env
else
    echo "env file exists. nothing to do."
fi

# TODO make role based @fatihalp
role=${CONTAINER_ROLE:-app}

if [ "$role" = "app" ]; then
    if [ "$INSTALLED" = "false" ]; then
        echo ".env installed is false starting installing"
        composer update
        php artisan install --ready
    fi
    php artisan cache:clear
    php artisan config:clear
    php artisan route:clear
    chmod -R 777 /var/www/storage
    chmod -R 777 /var/www/bootstrap
    exec docker-php-entrypoint "$@"
elif [ "$role" = "queue" ]; then
    echo "Running the queue ... "
    php /var/www/artisan queue:work --verbose --tries=3 --timeout=180
elif [ "$role" = "websocket" ]; then
    echo "Running the websocket server ... "
    php artisan websockets:serve
fi