#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

if [ ! -f ".env" ]; then
    echo "Creating env file for env $APP_ENV"
    cp .env-sail .env
else
    echo "env file exists."
fi

# TODO make role based @fatihalp
role=${CONTAINER_ROLE:-app}

if [ "$role" = "app" ]; then
    php artisan install --ready
    php artisan key:generate
    php artisan cache:clear
    php artisan config:clear
    php artisan route:clear
    exec docker-php-entrypoint "$@"
elif [ "$role" = "queue" ]; then
    echo "Running the queue ... "
    php /var/www/artisan queue:work --verbose --tries=3 --timeout=180
elif [ "$role" = "websocket" ]; then
    echo "Running the websocket server ... "
    php artisan websockets:serve
fi
 
