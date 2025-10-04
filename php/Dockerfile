FROM php:8.3-fpm

# Installer les dépendances système et extensions PHP
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    default-mysql-client \
    pkg-config \
    unzip \
    git \
    && docker-php-ext-install mysqli pdo_mysql \
    && rm -rf /var/lib/apt/lists/*