#docker compose build --no-cache && docker compose up --force-recreate -d
#docker compose down -v && docker compose up --build

FROM php:7.4-fpm  as php

ENV PHP_OPCACHE_ENABLE=1
ENV PHP_OPCACHE_ENABLE_CLI=1
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS=1
ENV PHP_OPCACHE_REVALIDATE_FREQ=1

RUN usermod -u 1000 www-data

RUN apt-get update -y
RUN apt-get install -y unzip libpq-dev libcurl4-gnutls-dev nginx
RUN docker-php-ext-install pdo pdo_mysql bcmath curl opcache

RUN docker-php-ext-enable opcache

WORKDIR /var/www

COPY --chown=www-data:www-data . .

COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY ./docker/nginx/site.conf /etc/nginx/default.conf


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN chmod -R 755 /var/www/storage
RUN chmod -R 755 /var/www/bootstrap

#ENTRYPOINT [ "docker/entrypoint.sh" ]

CMD ["docker/entrypoint.sh","php-fpm","-F"]