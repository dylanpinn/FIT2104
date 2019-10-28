FROM php:7.1.7-apache

RUN mkdir -p /usr/src/php
RUN tar --file /usr/src/php.tar.xz --extract --strip-components=1 --directory /usr/src/php
RUN cp "/usr/src/php/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN apt-get update && apt-get install -y libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev libfreetype6-dev

RUN docker-php-ext-configure gd --with-gd --with-webp-dir --with-jpeg-dir \
    --with-png-dir --with-zlib-dir --with-xpm-dir --with-freetype-dir \
    --enable-gd-native-ttf

RUN docker-php-ext-install gd

RUN docker-php-ext-install mysqli pdo_mysql
RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN echo "xdebug.remote_enable=1" >> "$PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini"
RUN echo "xdebug.remote_host=docker.for.mac.host.internal" >> "$PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini"
RUN echo "xdebug.remote_port=9000" >> "$PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini"
RUN echo 'xdebug.remote_log="/tmp/xdebug.log"' >> "$PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini"

COPY . /var/www/html
