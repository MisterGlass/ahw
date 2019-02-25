FROM php:fpm

RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql

COPY provisioning/php.ini /usr/local/etc/php/
