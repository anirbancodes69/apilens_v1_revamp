FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libonig-dev libzip-dev

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql mbstring zip pcntl

RUN pecl install redis && docker-php-ext-enable redis

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www