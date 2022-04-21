# FPM-BASE
FROM php:8.1-fpm as fpm-base

ARG UID=1000
ARG GID=1000

RUN usermod -u $UID www-data
RUN groupmod -g $GID www-data

COPY --from=mlocati/php-extension-installer:latest /usr/bin/install-php-extensions /usr/bin/

RUN install-php-extensions apcu bz2 gd intl opcache pcntl pdo_pgsql zip
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
    unzip \
    postgresql-client \
    git \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

ENV PATH="/usr/app/vendor/bin:/usr/app/bin:${PATH}"

RUN mv $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini

COPY .docker/app-prod/healthcheck.sh /usr/local/bin/healthcheck
COPY .docker/app-prod/extra.ini /usr/local/etc/php/conf.d/extra.ini
COPY .docker/app-prod/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN chmod +x /usr/local/bin/healthcheck

COPY --from=composer:2.3 /usr/bin/composer /usr/bin/composer

RUN chown $UID:$GID /var/www

USER www-data

WORKDIR /usr/app

# NODE-PROD
FROM node:17.7 as node-prod

ARG UID=1000
ARG GID=1000

RUN usermod -u $UID node
RUN groupmod -g $GID node


