FROM php:8.5-fpm-trixie

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        ${PHPIZE_DEPS} \
        git \
        zip \
        unzip \
        libzip-dev \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev

RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg

RUN docker-php-ext-install -j1 pdo_mysql

RUN docker-php-ext-install -j1 mysqli

RUN docker-php-ext-install -j1 gd

RUN docker-php-ext-install -j1 zip

COPY --from=composer/composer:2-bin /composer /usr/local/bin/composer

ARG UID=1000
ARG GID=1000

RUN groupmod -o -g ${GID} www-data \
    && usermod -o -u ${UID} www-data

WORKDIR /var/www/html

CMD ["php-fpm"]