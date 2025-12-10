# Versão específica do PHP FPM (Baseada no Debian Buster/Slim)
FROM php:7.4.33-fpm-buster

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
        # Dependências para libs do PHP
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mysqli \
        gd \
        zip \
        opcache \
    # Instalar as extensões Redis e Composer
    && pecl install redis \
    && docker-php-ext-enable redis \
    # Instalar Composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    # Limpar o cache
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Ajustar permissões e UID/GID
# O UID/GID 1000 é comum em ambientes WSL/Linux.
# Isso garante que os arquivos criados pelo PHP/Composer não fiquem com permissões estranhas.
ARG UID=1000
ARG GID=1000

RUN usermod -u ${UID} www-data && groupmod -g ${GID} www-data

# Definir o diretório de trabalho
WORKDIR /var/www/html