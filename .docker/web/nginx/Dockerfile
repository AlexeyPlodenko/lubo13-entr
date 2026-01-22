FROM nginx:1.29.4-alpine3.23

COPY ./.docker/web/nginx/website.conf /etc/nginx/templates/default.conf.template
COPY --chown=nginx:nginx ./public /app/public
COPY --chmod=0755 ./.docker/web/nginx/wait-for-php.sh /docker-entrypoint.d/99-wait-for-php.sh

WORKDIR /app/
