FROM postgres:12.2-alpine

MAINTAINER roger10cassares <roger10cassares@gmail.com>

RUN apk update \
    && apk add tzdata=2019c-r0

ENV TZ=America/Sao_Paulo

RUN echo "host all  all    0.0.0.0/0  md5" >> /var/lib/postgresql/data/pg_hba.conf

