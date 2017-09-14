# start with the official Composer image and name it
FROM composer:1.5 AS composer

# continue with the official PHP image
FROM php:7.1-fpm-alpine

# copy the Composer PHAR from the Composer image into the PHP image
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Install selected extensions and other stuff
RUN set -ex \
    # PHP extensions
    && apk add --no-cache --virtual .phpize-deps \
        $PHPIZE_DEPS imagemagick-dev libtool libmcrypt-dev \
    && export CFLAGS="$PHP_CFLAGS" CPPFLAGS="$PHP_CPPFLAGS" LDFLAGS="$PHP_LDFLAGS" \
    && docker-php-ext-install -j$(getconf _NPROCESSORS_ONLN) iconv mcrypt mysqli mbstring \
    # imagemagick
    && pecl install imagick-3.4.3 \
    && docker-php-ext-enable imagick \
    && apk add --no-cache --virtual .imagick-runtime-deps imagemagick \
    # cleanup
    && apk del .phpize-deps

# PHP.ini settings
COPY docker/php-fpm/php-ini-overrides.ini /usr/local/etc/php-fpm.d/99-overrides.ini

# Loads environment variables from AWS parameter store
RUN curl -L -o /bin/aws-env https://github.com/Droplr/aws-env/raw/master/bin/aws-env-linux-amd64 && \
  chmod +x /bin/aws-env

# Adds the application code to the container
WORKDIR /var/www/html
COPY composer.json .
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN composer update

COPY config/ config/
COPY web/app/plugins/wpw/ web/app/plugins/wpw/
COPY web/app/themes/ web/app/themes/
COPY web/app/wordfence-waf.php web/app/
COPY web/app/wflogs/rules.php web/app/wflogs/
VOLUME ["/var/www/html/web/app/uploads"]

# Environment variables
ENV APP_NAME=wpw
ENV AWS_REGION=us-east-1
ENV ENVIRONMENT=development

# Start point
CMD eval $(AWS_ENV_PATH=/${ENVIRONMENT}/${APP_NAME}/ /bin/aws-env) && php-fpm
