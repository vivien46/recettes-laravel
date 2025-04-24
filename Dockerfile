FROM php:8.2-apache

# Configuration Apache pour Laravel (DocumentRoot sur public + port 8080)
COPY ./my_apache.conf /etc/apache2/sites-available/000-default.conf

# Installer PHP & Node
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libpq-dev libzip-dev zip unzip curl gnupg \
    && docker-php-ext-install pdo pdo_pgsql zip gd \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Activer modules Apache
RUN a2enmod rewrite headers

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier Laravel
WORKDIR /var/www/html
COPY . .

# Installer dépendances Laravel + builder Vite
RUN composer install --no-dev --optimize-autoloader \
    && npm install \
    && npm run build

# Fixer les droits
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

RUN mkdir -p /var/www/html/storage/logs && \
    touch /var/www/html/storage/logs/laravel.log && \
    chmod -R 775 /var/www/html/storage && \
    chmod -R 775 /var/www/html/bootstrap/cache

RUN php artisan config:clear && php artisan config:cache

EXPOSE 8080
CMD ["apache2-foreground"]