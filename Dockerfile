FROM php:apache
RUN docker-php-ext-install pdo_mysql && a2enmod rewrite
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
EXPOSE 80
