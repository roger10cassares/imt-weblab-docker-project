FROM php:7.3.16-fpm-alpine3.11
 
MAINTAINER roger10cassares <roger10cassares@gmail.com>

RUN apk update \
    && apk add tzdata=2019c-r0

ENV TZ=America/Sao_Paulo 

RUN apk add postgresql-dev 

RUN docker-php-ext-install bcmath pdo pdo_pgsql

