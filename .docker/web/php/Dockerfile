FROM php:8.4.17-fpm-alpine3.23

ENV PHPREDIS_VERSION 6.3.0

# Here we specify the default arguments version.
# These arguments can be overriden in /compose.override.yaml for the local env. and
# in /bitbucket-pipelines.yml or /.github/workflows/deploy.yml for the staging and production envs.
ARG ENV="production"

# Install system dependencies required by PHP extensions
RUN apk add --no-cache \
    gmp \
    gmp-dev \
    curl-dev \
    libxml2-dev \
    oniguruma-dev \
    icu-dev \
    icu-libs \
    linux-headers \
    $PHPIZE_DEPS \
    && docker-php-ext-install \
    curl \
    mbstring \
    pdo_mysql \
    && apk del gmp-dev curl-dev libxml2-dev oniguruma-dev icu-dev $PHPIZE_DEPS \
    && rm -rf /tmp/pear \
    && rm -rf /var/cache/apk/*

WORKDIR /app

COPY --chown=www-data:www-data ./ /app

COPY ./.docker/web/php/common.ini /usr/local/etc/php/conf.d/common.ini
COPY ./.docker/web/php/${ENV}.ini /usr/local/etc/php/conf.d/env.ini

CMD ["php-fpm"]
