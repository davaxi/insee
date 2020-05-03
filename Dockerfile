FROM php:7.0-alpine

USER root
RUN apk update && \
    apk add --no-cache git && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
USER www-data

ENTRYPOINT ["composer", "--ansi"]