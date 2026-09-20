#!/bin/sh
set -e

if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env
fi

cd /var/www/html

composer install
npm install

php artisan key:generate --force
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link

php-fpm -D
npm run dev &
nginx -g 'daemon off;'
