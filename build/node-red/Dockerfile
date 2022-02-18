FROM nodered/node-red:1.0.4-12

MAINTAINER roger10cassares <roger10cassares@gmail.com>

USER root

RUN npm install -g node-red-admin

RUN apk update \
    && apk add tzdata=2019c-r0

ENV TZ=America/Sao_Paulo
