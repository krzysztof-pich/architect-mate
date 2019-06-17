FROM php:7.3.6-fpm-alpine3.9
RUN adduser -S kpich

RUN apk update; \
    apk upgrade;

RUN apk add --no-cache curl git zip bash
RUN apk add --co-cache composer
RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug-2.7.2 \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN curl --silent --show-error https://getcomposer.org/installer | php
RUN docker-php-ext-install mysqli
