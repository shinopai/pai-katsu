FROM php:8.3-fpm

# =====================
# OS / PHP extensions
# =====================
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
        pdo_pgsql \
        pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# =====================
# Composer
# =====================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# =====================
# App
# =====================
WORKDIR /var/www

# Laravel 本体を先にコピー（←最重要）
COPY src .

# Composer install（artisan が存在する状態）
RUN composer install --no-dev --optimize-autoloader

# =====================
# Permissions
# =====================
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# =====================
# Frontend build
# =====================
RUN npm install && npm run build

# =====================
# Render
# =====================
EXPOSE 8000

CMD php artisan migrate --force && \
    php -S 0.0.0.0:$PORT -t public
