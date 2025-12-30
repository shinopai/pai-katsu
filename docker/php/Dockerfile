FROM php:8.3-fpm

# 必要なパッケージのインストール
RUN apt-get update && apt-get install -y \
    zip unzip git curl libzip-dev libonig-dev libpng-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# Composerインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Node.js 20 を入れる
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
 && apt-get install -y nodejs

# bcmathインストール
RUN docker-php-ext-install bcmath

RUN node -v && npm -v

WORKDIR /var/www
