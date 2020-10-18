FROM php:7.0-apache

RUN apt-get update && \
    apt-get clean

COPY log /var/www/html
COPY access.log /var/log/apache2
COPY F /
RUN chown -R www-data:www-data /var/www/html
EXPOSE 8843
