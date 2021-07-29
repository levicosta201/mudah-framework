FROM php:7.3.12-fpm-alpine

RUN apk upgrade --update

RUN apk add nginx supervisor git openssh


RUN apk add --virtual build-dependencies build-base openssl-dev autoconf openssh \
    jpeg-dev libpng-dev freetype-dev libxslt-dev icu-dev libzip-dev bash supervisor bzip2-dev icu-libs git \
  && pecl install mongodb-1.6.1 redis \
  && docker-php-ext-enable mongodb redis \
  && docker-php-ext-configure pcntl --enable-pcntl \
  && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
  && docker-php-ext-configure intl --enable-intl

RUN docker-php-ext-install pcntl gd bcmath mbstring intl xsl pdo pdo_mysql soap zip bz2 calendar exif

# COMPOSER
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    mkdir /usr/local/.composer && chmod 777 -R /usr/local/.composer

# Set default locale for the environment
ENV LC_ALL C.UTF-8
ENV LANG en_US.UTF-8
ENV LANGUAGE en_US.UTF-8

## Uncomment this line and run `bin/dev build` to enable xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN docker-php-ext-install opcache

#INSTALL APCU
RUN pecl install apcu-5.1.11 && docker-php-ext-enable apcu


