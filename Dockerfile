FROM webdevops/php-apache-dev:7.1

RUN echo short_open_tag = On >> /opt/docker/etc/php/php.ini

WORKDIR /app
