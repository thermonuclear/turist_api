FROM php:7.4-fpm

# Install "curl", "libmemcached-dev", "libpq-dev", "libjpeg-dev",
#         "libpng-dev", "libfreetype6-dev", "libssl-dev", "libmcrypt-dev",
RUN apt-get update \
    apt-get upgrade -y \
    apt-get install -y --no-install-recommends \
        curl \
        libmemcached-dev \
        libz-dev \
        libpq-dev \
        libjpeg-dev \
        libpng-dev \
        libfreetype6-dev \
        libssl-dev \
        libmcrypt-dev \
        libonig-dev \
        cron \
        mc \
        git \
        libxml2-dev \
        nodejs \
    rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql pdo_pgsql bcmath opcache mysqli \
    # Install the PHP gd library
    docker-php-ext-install gd \
    docker-php-ext-configure gd \
            --prefix=/usr \
            --with-jpeg \
            --with-freetype

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