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

# Copier ton projet
WORKDIR /var/www/html
COPY . .

# Installer dépendances
RUN composer install --no-dev --optimize-autoloader \
    && npm install \
    && npm run build

# Préparer Laravel
RUN mkdir -p storage/logs && \
    touch storage/logs/laravel.log && \
    chmod -R 777 storage bootstrap/cache && \
    php artisan config:clear && \
    php artisan config:cache

# Exposer le bon port
EXPOSE 8080