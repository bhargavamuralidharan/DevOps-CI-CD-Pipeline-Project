FROM php:7.0-apache
LABEL Bhargava Murali
COPY src/ /var/www/html
EXPOSE 80
