FROM php:7.4-fpm as php

RUN usermod -u 1000 www-data

RUN apt-get update -y
RUN apt-get install -y unzip libpq-dev libcurl4-gnutls-dev
RUN docker-php-ext-install pdo pdo_mysql bcmath

WORKDIR /var/www
 
COPY --chown=www-data:www-data --chmod=777 . .

#COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

#COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
#COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
#COPY ./docker/nginx/site.conf /etc/nginx/default.conf

COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENTRYPOINT [ "docker/entrypoint.sh" ]

#CMD ["docker/entrypoint.sh","php-fpm","-F"]