FROM php:8.3-cli

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

# ① Laravel本体を先にコピー（artisanを含む）
COPY src .

# ② composer install（artisanが存在するのでOK）
RUN composer install --no-dev --optimize-autoloader

# ③ Node依存関係 & Vite build
RUN npm install && npm run build

# ④ 権限
RUN mkdir -p storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 10000

CMD php artisan migrate --force && \
    php artisan optimize && \
    php artisan serve --host=0.0.0.0 --port=10000
