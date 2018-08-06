FROM nanoninja/php-fpm:latest
RUN apt update && \
    apt install -y libmcrypt-dev \
    gcc \
    make \
    autoconf \
    libc-dev \
    pkg-config \
    && pecl install mcrypt-1.0.1 && docker-php-ext-enable mcrypt-1.0.1