FROM phpdockerio/php7-fpm:latest

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install  php7.0-mysql php7.0-imagick \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

WORKDIR "/var/www/html"
EXPOSE 9000

ONBUILD ADD . /var/www/html
ONBUILD ADD ./php-fpm/php-ini-overrides.ini /etc/php/7.0/fpm/conf.d/99-overrides.ini

ENV WP_ENV
ENV WP_HOME
ENV WP_SITEURL
ENV DB_NAME
ENV DB_USER
ENV DB_PASSWORD
ENV DB_HOST
ENV AUTH_KEY
ENV SECURE_AUTH_KEY
ENV LOGGED_IN_KEY
ENV NONCE_KEY
ENV AUTH_SALT
ENV SECURE_AUTH_SALT
ENV LOGGED_IN_SALT
ENV NONCE_SALT
ENV DISABLE_WP_CRON
