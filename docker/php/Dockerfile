FROM php:8.2-fpm-bookworm

# Variáveis de ambiente
ENV DEBIAN_FRONTEND noninteractive

# Instalar extensões e utilitários necessários
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        zip \
        unzip \
        libzip-dev \
        libpng-dev \
        libjpeg-dev \
        libonig-dev \
        libpq-dev \
    # Instalação das extensões
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mysqli \
        gd \
        zip \
        opcache \
    # Instalar a extensão Redis (via PECL) e habilitá-la
    && pecl install redis \
    && docker-php-ext-enable redis \
    # Instalar Composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    # Limpar o cache
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Ajustar permissões e UID/GID; UID/GID 1000 é comum em ambientes WSL/Linux.
ARG UID=1000
ARG GID=1000

# Adicionar 'usermod -u ${UID}' e 'groupmod -g ${GID}' como comando separado
RUN usermod -u ${UID} www-data && groupmod -g ${GID} www-data

WORKDIR /var/www/html