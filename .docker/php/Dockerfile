FROM php:8.4-fpm-alpine3.23

RUN apk update \
    && apk add \
    bash \
    vim \
    zip \
    unzip \
    curl \
    git \
    unzip \
    nodejs \
    npm \
    yarn \
    libpq-dev \
    autoconf \
    g++ \
    make \
    openssl-dev \
    icu-dev \
    && docker-php-ext-install pdo_mysql intl \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer