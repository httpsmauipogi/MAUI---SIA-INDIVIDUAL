# syntax=docker/dockerfile:1

# ---------- Stage 1: compile front-end assets with Vite ----------
FROM node:22-alpine AS assets

WORKDIR /app
COPY package.json package-lock.json vite.config.js postcss.config.js tailwind.config.js ./
COPY resources ./resources
RUN npm ci && npm run build

# ---------- Stage 2: install production PHP dependencies ----------
FROM composer:2 AS vendor

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --prefer-dist --no-interaction --optimize-autoloader
COPY . .
RUN composer dump-autoload --optimize --no-dev --no-interaction

# ---------- Stage 3: runtime image (Nginx + PHP-FPM in one container) ----------
FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
        nginx \
        supervisor \
        curl \
        libzip-dev \
        libpng-dev \
        libjpeg-turbo-dev \
        freetype-dev \
        icu-dev \
        oniguruma-dev \
        libxml2-dev \
    && apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_mysql bcmath gd intl mbstring zip exif pcntl \
    && docker-php-ext-enable opcache \
    && apk del .build-deps

WORKDIR /var/www/html

COPY --from=vendor /app/vendor ./vendor
COPY --from=assets /app/public/build ./public/build
COPY . .

COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/99-healix.ini

# Never ship locally generated caches (they can reference dev-only providers)
# or local log files into the production image.
RUN find bootstrap/cache -type f -name '*.php' -delete \
    && find storage/logs -type f -name '*.log' -delete

RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R ug+rwX storage bootstrap/cache

EXPOSE 80

HEALTHCHECK --interval=30s --timeout=5s --start-period=60s --retries=3 \
    CMD curl -fsS http://127.0.0.1/up || exit 1

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
