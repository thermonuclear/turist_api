FROM php:7.4-fpm

# ставим кучу пакетов, которые нужны для работы php, composer
RUN apt-get update && apt-get install -y \
    build-essential \
    libzip-dev \
    libmemcached-dev \
    libz-dev \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libssl-dev \
    libmcrypt-dev \
    libonig-dev \
    locales \
    zip \
    unzip \
    curl \
    cron \
    mc

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN set -eux; \
    # Install the PHP pdo_mysql extention
    docker-php-ext-install pdo_mysql; \
    # Install the PHP pdo_pgsql extention
    docker-php-ext-install pdo_pgsql; \
    docker-php-ext-install bcmath; \
    docker-php-ext-install zip; \
    docker-php-ext-install exif; \
    docker-php-ext-install pcntl; \
    # Install the PHP gd library
    docker-php-ext-configure gd \
            --prefix=/usr \
            --with-jpeg \
            --with-freetype; \
    docker-php-ext-install gd; \
    php -r 'var_dump(gd_info());'

# php драйвер для работы с redis
# RUN pecl install redis-5.2.2 \
# 	# xdebug
#     && pecl install xdebug-2.9.6 \
#     && docker-php-ext-enable redis xdebug

# Install composer and add its bin to the PATH.
RUN curl -s http://getcomposer.org/installer | php && \
    echo "export PATH=${PATH}:/var/www/vendor/bin" >> ~/.bashrc && \
    mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/
