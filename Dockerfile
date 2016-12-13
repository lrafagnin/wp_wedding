FROM phpdockerio/php7-fpm:latest

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install  php7.0-mysql php7.0-imagick \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

ADD . /var/www/html
ADD ./php-fpm/php-ini-overrides.ini /etc/php/7.0/fpm/conf.d/99-overrides.ini

WORKDIR "/var/www/html"

# Install composer dependencies
RUN composer update

# TODO: Run SASS

VOLUME ["/var/www/html/web/app/uploads"]

EXPOSE 9000
