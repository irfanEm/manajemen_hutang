FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    zip unzip git curl libzip-dev libpng-dev  libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli mbstring zip gd intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html