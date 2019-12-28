FROM php:7.3-fpm

EXPOSE 9000
WORKDIR /app

RUN printf "deb http://archive.debian.org/debian/ jessie main\ndeb http://security.debian.org jessie/updates main\n" > /etc/apt/sources.list

RUN apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
        curl \
        git

RUN docker-php-ext-install iconv bcmath opcache pcntl pdo pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN sed -i 's/www\-data/root/' /usr/local/etc/php-fpm.d/www.conf

RUN apt-get install zip

RUN curl -sS https://getcomposer.org/installer | php -- --filename=composer --install-dir=/usr/local/bin

ADD . /app

ADD composer.json /app/composer.json
ADD composer.lock /app/composer.lock
RUN composer install --ignore-platform-reqs --no-scripts --no-autoloader --no-progress --no-suggest
RUN composer dump-autoload

CMD ./docker-entrypoint.sh
