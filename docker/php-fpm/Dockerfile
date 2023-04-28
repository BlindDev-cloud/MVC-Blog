FROM php:8.1-fpm

# install packages and extentions

RUN apt-get update && \
    apt-get upgrade -y && \
    docker-php-ext-install pdo_mysql

# install composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# open port

EXPOSE 9000

# Run php-fpm

CMD 'php-fpm'