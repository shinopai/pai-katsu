FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    nodejs \
    npm \
    && docker-php-ext-configure intl \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        intl

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# PHP依存関係
COPY src/composer.json src/composer.lock ./
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-scripts

# Node依存関係（ここ重要）
COPY src/package.json src/package-lock.json ./
RUN npm install

# アプリ本体
COPY src .

# Vite build（manifestを確実に作る）
RUN npm run build

RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 10000

CMD php artisan key:generate --force && \
    php artisan migrate --force && \
    php artisan optimize && \
    php artisan serve --host=0.0.0.0 --port=10000
