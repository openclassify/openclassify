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
        echo ".env installed is false starting installing"
        php artisan install --ready
    exec docker-php-entrypoint "$@"
elif [ "$role" = "queue" ]; then
    echo "Running the queue ... "
    php /var/www/artisan queue:work --verbose --tries=3 --timeout=180
elif [ "$role" = "websocket" ]; then
    echo "Running the websocket server ... "
    php artisan websockets:serve
fi
