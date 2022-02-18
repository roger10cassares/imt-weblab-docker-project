FROM node:12.16.2-alpine3.11

MAINTAINER username <email@info>

RUN apk update \
    && apk add tzdata=2019c-r0

ENV TZ=America/Sao_Paulo

###Code to be implemented by SCIENTIFIC INITIATION RESEARCHER###

##Next lines creates the Docker file image for nodejs

RUN mkdir -p /usr/src/app/node_modules \
    && chown -R node:node /usr/src/app

WORKDIR /usr/src/app

COPY ./src/weblab-app-example/package*.json ./

RUN npm install

COPY ./src/weblab-app-example ./

COPY --chown=node:node . .

USER node

EXPOSE 3300

CMD [ "node", "app.js" ]
