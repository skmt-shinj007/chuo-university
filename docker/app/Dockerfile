FROM php:7.4-fpm
LABEL maintener="skamaoto junichi<sakamoto.access@gmail.com>"

# module
RUN apt-get update && apt-get install -y \
        git \
        zip \
        unzip \
        libzip-dev \
        vim
RUN docker-php-ext-install pdo_mysql zip

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --version=2.0.4
RUN mv composer.phar /usr/bin/composer

# xdebug
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

# Node.js
RUN apt-get install -y nodejs
RUN curl -sS https://www.npmjs.com/install.sh | sh
RUN npm install -g n
RUN n stable
RUN apt-get purge -y nodejs
RUN npm install -g yarn

RUN groupadd -g 1000 gpagent && \
    useradd -g gpagent -G sudo -m -s /bin/bash agent &&\
    echo 'agent:password' | chpasswd

USER agent