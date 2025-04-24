# Étape 1 : PHP avec Apache
FROM php:8.2-apache

# Étape 2 : Installer les extensions PHP et Node.js
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libpq-dev libzip-dev zip unzip curl gnupg \
    && docker-php-ext-install pdo pdo_pgsql zip gd \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Étape 3 : Activer les modules Apache nécessaires
RUN a2enmod rewrite headers

# Étape 4 : Copier la config Apache personnalisée
COPY ./my_apache.conf /etc/apache2/sites-available/000-default.conf

# Étape 5 : Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Étape 6 : Copier le code Laravel
WORKDIR /var/www/html
COPY . .

# Étape 7 : Installer les dépendances Laravel
RUN composer install --no-dev --optimize-autoloader \
    && npm install \
    && npm run build

# Étape 8 : Préparer Laravel
RUN mkdir -p storage/logs \
    && touch storage/logs/laravel.log \
    && chmod -R 777 storage bootstrap/cache \
    && php artisan config:clear \
    && php artisan config:cache

# Étape 9 : Cloud Run écoute uniquement sur 8080
EXPOSE 8080
CMD ["apache2-foreground"]