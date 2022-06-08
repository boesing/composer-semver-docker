FROM composer:2.3.7 AS composer

FROM php:8.1-cli-alpine as compile

# Add composer binary to the compiler
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Setup build directory
RUN mkdir -p /usr/local/source
WORKDIR /usr/local/source

COPY composer.json ./
COPY composer.lock ./
COPY src/ ./src
COPY main.php ./
COPY box.json ./

# Install composer dependencies
RUN composer install

# Create PHAR
RUN vendor/bin/box compile

FROM php:8.1-cli-alpine
COPY --from=compile /usr/local/source/main.phar /usr/local/bin/main.phar

ENTRYPOINT ["php", "/usr/local/bin/main.phar", "semver:match"]
CMD ["php", "/usr/local/bin/main.phar", "semver:match"]




