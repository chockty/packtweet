FROM php:5.6-fpm
RUN apt-get update && docker-php-ext-install mysqli pdo_mysql
COPY php.ini /usr/local/etc/php/