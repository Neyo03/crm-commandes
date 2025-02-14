FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
  git \
  unzip \
  libicu-dev \
  libpq-dev \
  libzip-dev \
  && docker-php-ext-install intl pdo pdo_mysql zip

RUN curl -fsSL https://deb.nodesource.com/setup_23.x | bash - &&   apt-get install -y nodejs &&   npm install -g npm@latest

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
