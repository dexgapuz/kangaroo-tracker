FROM php:8.2-fpm

WORKDIR /var/www/html

RUN apt-get update \
    && apt-get install --quiet --yes --no-install-recommends \
     libzip-dev \
     unzip \
     libpng-dev \
     libfreetype6-dev \
     libjpeg62-turbo-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install zip pdo pdo_mysql bcmath gd

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN groupadd --gid 1000 appuser \
    && useradd --uid 1000 -g appuser \
    -G www-data,root --shell /bin/bash \
    --create-home appuser

USER appuser
