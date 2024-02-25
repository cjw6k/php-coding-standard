ARG PHP_VERSION=8.2
ARG ALPINE_VERSION=3.18

FROM php:${PHP_VERSION}-cli-alpine${ALPINE_VERSION}

ARG LIBZIP_DEV_VERSION="1.9.2-r2"

RUN apk add --no-cache \
    libzip-dev=${LIBZIP_DEV_VERSION}

RUN docker-php-ext-install "-j$(nproc)" zip

WORKDIR /opt/phpcs
COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-cache --no-interaction

ENTRYPOINT ["vendor/bin/phpunit"]
