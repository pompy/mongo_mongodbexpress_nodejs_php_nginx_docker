FROM php:7.4-fpm


RUN apt-get update && apt-get install -y zlib1g-dev libicu-dev g++ libssl-dev


#RUN pecl install mongodb-1.12.0 && echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/ext-mongodb.ini

#RUN pecl install mongodb && docker-php-ext-enable mongodb

#RUN docker-php-ext-install pdo pdo_mysql



RUN apt-get install -y autoconf pkg-config libssl-dev
RUN pecl install mongodb
RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini



RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN docker-php-ext-enable pdo_mysql

RUN pecl install xdebug && docker-php-ext-enable xdebug