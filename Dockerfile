FROM composer:2.6.5 as composer

FROM node:18.18.1 as node

FROM php:8.0-apache

WORKDIR /var/www/html

RUN apt-get update -y

RUN apt-get upgrade -y

RUN apt-get install -y libzip-dev wget vim git zip unzip python3 python3-pip

COPY php.ini $PHP_INI_DIR/php.ini

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules

COPY --from=node /usr/local/bin/node /usr/local/bin/node

RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

RUN npm i -g yarn

RUN chown -R www-data:www-data /var/www/html

RUN chmod -R 755 /var/www/html

RUN a2enmod rewrite

RUN service apache2 restart
