FROM php:8.1-fpm

WORKDIR /var/www


RUN apt-get update && apt-get install -y \
        build-essential \
        wget \
        libpq-dev \
        libzip-dev \
        libjpeg-dev \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
        locales \
        zip \
        jpegoptim optipng pngquant gifsicle \
        vim \
        unzip \
        git \
        curl \
        libonig-dev \
        locales \
        nodejs \
        npm \
        zlib1g-dev \
        libicu-dev \
        supervisor \
        g++ \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install pgsql \
    && docker-php-ext-install zip \
    && docker-php-ext-install gd \
    && docker-php-ext-enable pgsql


RUN apt-get install -y libmagickwand-dev --no-install-recommends && rm -rf /var/lib/apt/lists/*
RUN printf "\n" | pecl install imagick
RUN docker-php-ext-enable imagick

ADD ./php.ini /usr/local/etc/php/php.ini

RUN curl https://www.npmjs.com/install.sh | sh

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


USER root

EXPOSE 9000
CMD ["php-fpm"]
