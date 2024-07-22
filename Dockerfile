ARG ALPINE_VERSION=3.20
ARG EZA_VERSION=0.18.16-r0
ARG LIBZIP_DEV_VERSION=1.10.1-r0
ARG PHP_VERSION=8.3

ARG UID=1000
ARG GID=1000


###
### context
###
FROM alpine:${ALPINE_VERSION} AS build-context

ARG EZA_VERSION

RUN apk add --no-cache eza=${EZA_VERSION}

WORKDIR /opt/php-coding-standard
COPY . .

ENTRYPOINT ["eza"]
CMD ["--all", "--tree", "--icons"]


###
### base
###
FROM php:${PHP_VERSION}-cli-alpine${ALPINE_VERSION} AS base

ARG GID
ARG LIBZIP_DEV_VERSION
ARG UID

RUN addgroup -g ${GID} phpcs \
 && adduser -u ${UID} -h /home/phpcs/ -s /sbin/nologin -D -G phpcs -g phpcs phpcs

WORKDIR /opt/phpcs
RUN chown phpcs:phpcs /opt/phpcs

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apk add --no-cache \
    libzip-dev=${LIBZIP_DEV_VERSION}

RUN docker-php-ext-install "-j$(nproc)" zip


###
### dependencies
###
FROM base AS dependencies

COPY --chown=phpcs:phpcs composer.json ./

USER phpcs
RUN composer install --no-dev --no-autoloader --no-interaction


###
### dev
###
FROM base AS dev

COPY --from=dependencies --chown=phpcs:phpcs /opt/phpcs/vendor ./vendor
COPY --chown=phpcs:phpcs vendor-bin ./vendor-bin
COPY --chown=phpcs:phpcs composer.json ./

USER phpcs
RUN composer install --no-interaction

ENTRYPOINT ["/bin/ash"]


###
### test
###
FROM dev AS test

COPY --chown=phpcs:phpcs cjw6k ./cjw6k
COPY --chown=phpcs:phpcs tests ./tests
COPY --chown=phpcs:phpcs phpunit.xml phpcs.xml ./

ENTRYPOINT ["/usr/bin/composer"]
CMD ["test"]
