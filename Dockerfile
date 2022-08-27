FROM php:7.4-apache
LABEL maintainer="DaKa"
ENV TZ=America/Bogota
WORKDIR /var/www/html
# COPY ./docker/php.ini /etc/php/php.ini
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime  \
    && a2enmod rewrite \
    && echo $TZ > /etc/timezone \
    && apt-get update && apt install -y \
    curl \
    libcap2-bin \
    nano \
    wget \
    zlib1g-dev \
    libicu-dev \
    libpng-dev \
    libxml2-dev \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-install zip 
    # && docker-php-ext-configure gd \
    # && docker-php-ext-install -j$(nproc) gd \
# RUN docker-php-ext-install mysql && docker-php-ext-enable mysql 
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli 
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
COPY . /var/www/html
