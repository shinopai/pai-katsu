FROM php:8.3-fpm

# ===== システム依存 =====
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# ===== Composer =====
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ===== 作業ディレクトリ =====
WORKDIR /var/www

# ===== Laravelファイル =====
COPY . .

# ===== 権限設定 =====
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# ===== PHP依存 =====
RUN composer install --no-dev --optimize-autoloader

# ===== フロントエンド =====
RUN npm install && npm run build

# ===== ポート =====
EXPOSE 8000

# ===== 起動 =====
CMD php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=8000
