FROM php:7.0-cli

RUN apt-get update && apt-get install -y \
        libxml2-dev \
    && docker-php-ext-install -j$(nproc) soap

WORKDIR /console

CMD [ "php", "./app.php" ]
