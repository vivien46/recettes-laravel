#forcer le rebuild de l'image
# syntax=docker/dockerfile:1.4
FROM php:8.2

# Installer extensions PHP + Node.js
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libpq-dev libzip-dev zip unzip curl gnupg git \
    && docker-php-ext-install pdo pdo_pgsql zip gd \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Installer dépendances Laravel + Vite + builder Vite
RUN composer install --no-dev --optimize-autoloader \
    && npm install \
    && npm run build \
    && php artisan config:clear \
    && php artisan config:cache \
    && mkdir -p storage/logs && touch storage/logs/laravel.log \
    && chmod -R 777 storage bootstrap/cache

EXPOSE 8080
CMD ["apache2-foreground"]